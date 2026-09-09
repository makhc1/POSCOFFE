<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Outlet;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KasirController extends Controller
{
    /**
     * Display POS Cashier Counter Interface.
     */
    public function pos(Request $request): View
    {
        $categories = Category::withCount('products')->orderBy('sort_order', 'asc')->get();
        $selectedCatSlug = $request->query('category');
        $search = $request->query('q');

        $query = Product::with('category')->where('is_available', true);

        if ($selectedCatSlug) {
            $query->whereHas('category', function ($q) use ($selectedCatSlug) {
                $q->where('slug', $selectedCatSlug);
            });
        }

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $products = $query->orderBy('is_best_seller', 'desc')->get();
        $outlets = Outlet::all();
        $user = Auth::user();

        return view('kasir.pos', compact('categories', 'products', 'outlets', 'selectedCatSlug', 'search', 'user'));
    }

    /**
     * Process POS cashier transaction order.
     */
    public function storePosOrder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'nullable|string|max:20',
            'order_type' => 'required|in:dine_in,takeaway,delivery',
            'table_number' => 'nullable|string|max:50',
            'outlet_id' => 'required|exists:outlets,id',
            'payment_method' => 'required|in:cash,qris,gopay,bca',
            'cash_received' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:200',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.sugar_level' => 'nullable|string',
            'items.*.ice_level' => 'nullable|string',
            'items.*.extra_shots' => 'nullable|integer|min:0',
            'items.*.spicy_level' => 'nullable|integer|min:0',
            'items.*.notes' => 'nullable|string',
        ]);

        $subtotal = 0;
        $itemsData = [];

        foreach ($validated['items'] as $it) {
            $product = Product::findOrFail($it['product_id']);
            $unitPrice = (float) $product->price;
            $extraShots = (int) ($it['extra_shots'] ?? 0);
            $itemSubtotal = ($unitPrice + ($extraShots * 4000)) * $it['quantity'];

            $subtotal += $itemSubtotal;
            $itemsData[] = [
                'product' => $product,
                'product_id' => $product->id,
                'quantity' => $it['quantity'],
                'unit_price' => $unitPrice,
                'sugar_level' => $it['sugar_level'] ?? 'Normal (100%)',
                'ice_level' => $it['ice_level'] ?? 'Normal Ice',
                'extra_shots' => $extraShots,
                'spicy_level' => (int) ($it['spicy_level'] ?? 0),
                'notes' => $it['notes'] ?? null,
                'subtotal' => $itemSubtotal,
            ];
        }

        $tax = round($subtotal * 0.10);
        $total = $subtotal + $tax;

        $orderNumber = 'POS-'.date('Ymd').'-'.strtoupper(Str::random(4));

        $order = Order::create([
            'order_number' => $orderNumber,
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'] ?? 'Kasir Walk-in',
            'order_type' => $validated['order_type'],
            'table_number' => $validated['order_type'] === 'dine_in' ? ($validated['table_number'] ?? 'Kasir / Counter') : 'Takeaway Counter',
            'outlet_id' => $validated['outlet_id'],
            'subtotal' => $subtotal,
            'discount_amount' => 0,
            'tax_amount' => $tax,
            'total_amount' => $total,
            'status' => 'brewing', // Auto sent to barista kitchen display
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'paid',
            'notes' => $validated['notes'] ?? null,
        ]);

        foreach ($itemsData as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'sugar_level' => $item['sugar_level'],
                'ice_level' => $item['ice_level'],
                'extra_shots' => $item['extra_shots'],
                'spicy_level' => $item['spicy_level'],
                'notes' => $item['notes'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        $cashReceived = (float) ($validated['cash_received'] ?? $total);
        $cashChange = max(0, $cashReceived - $total);

        // --- DUITKU PAYMENT GATEWAY INTEGRATION (SANDBOX) ---
        $paymentUrl = null;
        $qrString = null;
        $vaNumber = null;

        // Jika pembayaran non-tunai, request ke Duitku
        if (in_array($validated['payment_method'], ['qris', 'gopay', 'bca'])) {
            $order->update(['payment_status' => 'unpaid', 'status' => 'pending']);
            
            $duitkuMerchantCode = env('DUITKU_MERCHANT_CODE', 'DXXXX');
            $duitkuApiKey = env('DUITKU_API_KEY', 'sandbox_apikey');
            
            $amountInt = (int) $total;
            $signature = md5($duitkuMerchantCode . $orderNumber . $amountInt . $duitkuApiKey);
            
            $duitkuItems = [];
            foreach ($itemsData as $item) {
                $duitkuItems[] = [
                    'name' => $item['product']->name,
                    'price' => (int) ($item['unit_price'] + ($item['extra_shots'] * 4000)),
                    'quantity' => (int) $item['quantity'],
                ];
            }
            if ($tax > 0) {
                $duitkuItems[] = [
                    'name' => 'Pajak PB1 (10%)',
                    'price' => (int) $tax,
                    'quantity' => 1,
                ];
            }

            $duitkuPaymentMethod = match($validated['payment_method']) {
                'qris' => 'SP', // ShopeePay QRIS
                'gopay' => 'OV', // OVO
                'bca' => 'BC', // BCA VA
                default => 'VC'
            };

            $params = [
                'merchantCode' => $duitkuMerchantCode,
                'paymentAmount' => $amountInt,
                'paymentMethod' => $duitkuPaymentMethod,
                'merchantOrderId' => $orderNumber,
                'productDetails' => 'Pesanan Kopi Gacoan - ' . $orderNumber,
                'email' => 'customer@kopigacoan.com',
                'customerVaName' => $validated['customer_name'] ?: 'Pelanggan Walk-in',
                'phoneNumber' => $validated['customer_phone'] ?? '08123456789',
                'itemDetails' => $duitkuItems,
                'callbackUrl' => url('/api/payment/duitku-callback'),
                'returnUrl' => route('kasir.pos'),
                'signature' => $signature,
                'expiryPeriod' => 60
            ];

            $qrString = null;
            $vaNumber = null;

            try {
                $response = \Illuminate\Support\Facades\Http::post('https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry', $params);
                $result = $response->json();
                
                \Illuminate\Support\Facades\Log::info('Duitku Direct API Response: ' . json_encode($result));

                if (isset($result['statusCode']) && $result['statusCode'] == '00') {
                    $paymentUrl = $result['paymentUrl'] ?? null;
                    $qrString = $result['qrString'] ?? null;
                    $vaNumber = $result['vaNumber'] ?? null;
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Duitku API Error: ' . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'order_number' => $order->order_number,
            'total' => $total,
            'formatted_total' => 'Rp '.number_format($total, 0, ',', '.'),
            'cash_received' => $cashReceived,
            'cash_change' => $cashChange,
            'formatted_change' => 'Rp '.number_format($cashChange, 0, ',', '.'),
            'payment_url' => $paymentUrl,
            'qr_string' => $qrString,
            'va_number' => $vaNumber,
            'payment_method' => $validated['payment_method'],
            'message' => ($paymentUrl || $qrString || $vaNumber) ? 'Transaksi dicatat. Menunggu pembayaran via Duitku.' : 'Transaksi POS berhasil dicatat & dikirim ke antrean barista!',
        ]);
    }



    /**
     * Shift Sales Recap for Cashier.
     */
    public function recap(): View
    {
        $todayOrders = Order::with(['items.product', 'outlet'])
            ->whereDate('created_at', today())
            ->where('payment_status', 'paid')
            ->latest()
            ->get();

        $totalRevenue = $todayOrders->sum('total_amount');
        $totalCash = $todayOrders->where('payment_method', 'cash')->sum('total_amount');
        $totalNonCash = $todayOrders->where('payment_method', '!=', 'cash')->sum('total_amount');

        return view('kasir.recap', compact('todayOrders', 'totalRevenue', 'totalCash', 'totalNonCash'));
    }

    /**
     * Duitku Callback Webhook handler.
     */
    public function duitkuCallback(Request $request): JsonResponse
    {
        $merchantCode = env('DUITKU_MERCHANT_CODE', 'DXXXX');
        $apiKey = env('DUITKU_API_KEY', 'sandbox_apikey');
        
        $merchantOrderId = $request->input('merchantOrderId');
        $amount = $request->input('amount');
        $resultCode = $request->input('resultCode');
        $signature = $request->input('signature');
        
        $mySignature = md5($merchantCode . $amount . $merchantOrderId . $apiKey);
        
        if ($mySignature === $signature) {
            $order = Order::where('order_number', $merchantOrderId)->first();
            
            if ($order) {
                if ($resultCode == '00') {
                    $order->update([
                        'payment_status' => 'paid',
                        'status' => 'brewing'
                    ]);
                } else if ($resultCode == '01') {
                    $order->update([
                        'payment_status' => 'failed',
                        'status' => 'cancelled'
                    ]);
                }
                return response()->json(['success' => true]);
            }
        }
        
        return response()->json(['success' => false, 'message' => 'Invalid signature or order not found'], 400);
    }
}
