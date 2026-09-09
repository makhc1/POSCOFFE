<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Outlet;
use App\Models\Promotion;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Show Checkout Page.
     */
    public function checkout(Request $request): View|RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('menu.index')->with('warning', 'Keranjang belanja kamu masih kosong. Pilih menu favoritmu dulu yuk!');
        }

        $outlets = Outlet::where('status', '!=', 'Tutup')->orderBy('city', 'asc')->get();
        $voucher = $request->session()->get('voucher');

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['unit_price'] * $item['quantity'];
            if (! empty($item['extra_shots']) && $item['extra_shots'] > 0) {
                $subtotal += ($item['extra_shots'] * 4000) * $item['quantity'];
            }
        }

        $discount = 0;
        if ($voucher) {
            $promo = Promotion::where('code', $voucher['code'])->where('is_active', true)->first();
            if ($promo && $subtotal >= $promo->min_spend) {
                $discount = $promo->calculateDiscount($subtotal);
            }
        }

        $tax = round(($subtotal - $discount) * 0.10);
        $total = max(0, $subtotal - $discount + $tax);

        return view('checkout.index', compact(
            'cart',
            'outlets',
            'voucher',
            'subtotal',
            'discount',
            'tax',
            'total'
        ));
    }

    /**
     * Process and place order.
     */
    public function placeOrder(Request $request): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('menu.index')->with('error', 'Keranjang kamu kosong.');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:100',
            'order_type' => 'required|in:dine_in,takeaway,delivery',
            'outlet_id' => 'required|exists:outlets,id',
            'table_number' => 'nullable|string|max:50',
            'delivery_address' => 'nullable|string|max:255',
            'payment_method' => 'required|in:qris,gopay,bca,cash',
            'notes' => 'nullable|string|max:300',
        ]);

        $voucher = $request->session()->get('voucher');

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['unit_price'] * $item['quantity'];
            if (! empty($item['extra_shots']) && $item['extra_shots'] > 0) {
                $subtotal += ($item['extra_shots'] * 4000) * $item['quantity'];
            }
        }

        $discount = 0;
        $voucherCode = null;
        if ($voucher) {
            $promo = Promotion::where('code', $voucher['code'])->where('is_active', true)->first();
            if ($promo && $subtotal >= $promo->min_spend) {
                $discount = $promo->calculateDiscount($subtotal);
                $voucherCode = $promo->code;
            }
        }

        $tax = round(($subtotal - $discount) * 0.10);
        $total = max(0, $subtotal - $discount + $tax);

        // Generate clean Order Number (GC-YYYYMMDD-RAND4)
        $orderNumber = 'GC-'.date('Ymd').'-'.strtoupper(Str::random(4));

        $order = Order::create([
            'order_number' => $orderNumber,
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_email' => $validated['customer_email'] ?? null,
            'order_type' => $validated['order_type'],
            'table_number' => $validated['order_type'] === 'dine_in' ? ($validated['table_number'] ?? 'Meja Regular') : null,
            'delivery_address' => $validated['order_type'] === 'delivery' ? ($validated['delivery_address'] ?? null) : null,
            'outlet_id' => $validated['outlet_id'],
            'subtotal' => $subtotal,
            'discount_amount' => $discount,
            'tax_amount' => $tax,
            'total_amount' => $total,
            'voucher_code' => $voucherCode,
            'status' => 'brewing', // Auto barista brewing simulator
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'paid',
            'notes' => $validated['notes'] ?? null,
        ]);

        // Insert Order Items
        foreach ($cart as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'sugar_level' => $item['sugar_level'] ?? 'Normal (100%)',
                'ice_level' => $item['ice_level'] ?? 'Normal Ice',
                'extra_shots' => (int) ($item['extra_shots'] ?? 0),
                'spicy_level' => (int) ($item['spicy_level'] ?? 0),
                'notes' => $item['notes'] ?? null,
                'subtotal' => ($item['unit_price'] + ((int) ($item['extra_shots'] ?? 0) * 4000)) * $item['quantity'],
            ]);
        }

        // Clear cart and voucher session
        $request->session()->forget(['cart', 'voucher']);

        return redirect()->route('order.success', $order->order_number)
            ->with('success', 'Pesanan kamu berhasil dibuat dan langsung disiapkan oleh Barista!');
    }

    /**
     * Show Order Success receipt page.
     */
    public function success(string $orderNumber): View
    {
        $order = Order::with(['items.product', 'outlet'])->where('order_number', $orderNumber)->firstOrFail();

        // Build WhatsApp text
        $waText = "Halo Kopi Gacoan! Saya sudah order via website:\n";
        $waText .= "*No. Pesanan:* {$order->order_number}\n";
        $waText .= "*Nama:* {$order->customer_name}\n";
        $waText .= '*Tipe:* '.strtoupper($order->order_type).($order->table_number ? " ({$order->table_number})" : '')."\n";
        $waText .= "*Cabang:* {$order->outlet?->name}\n";
        $waText .= '*Total:* Rp '.number_format($order->total_amount, 0, ',', '.')."\n\n";
        $waText .= 'Mohon bantu cek pesanannya ya kak. Terima kasih!';

        $waLink = 'https://wa.me/6281234567890?text='.urlencode($waText);

        return view('checkout.success', compact('order', 'waLink'));
    }

    /**
     * Show live order tracking page.
     */
    public function track(Request $request, ?string $orderNumber = null): View
    {
        $searchNumber = $orderNumber ?? $request->query('order_number');
        $order = null;

        if ($searchNumber) {
            $order = Order::with(['items.product', 'outlet'])
                ->where('order_number', trim($searchNumber))
                ->first();
        }

        return view('orders.track', compact('order', 'searchNumber'));
    }
}
