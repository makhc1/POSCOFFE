<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Get cart contents from session.
     */
    public function getCart(Request $request): JsonResponse
    {
        $cart = $request->session()->get('cart', []);
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
            } else {
                $request->session()->forget('voucher');
                $voucher = null;
            }
        }

        $tax = round(($subtotal - $discount) * 0.10); // PB1 10%
        $total = max(0, $subtotal - $discount + $tax);

        return response()->json([
            'items' => array_values($cart),
            'total_items' => array_sum(array_column($cart, 'quantity')),
            'subtotal' => $subtotal,
            'formatted_subtotal' => 'Rp '.number_format($subtotal, 0, ',', '.'),
            'discount' => $discount,
            'formatted_discount' => 'Rp '.number_format($discount, 0, ',', '.'),
            'tax' => $tax,
            'formatted_tax' => 'Rp '.number_format($tax, 0, ',', '.'),
            'total' => $total,
            'formatted_total' => 'Rp '.number_format($total, 0, ',', '.'),
            'voucher' => $voucher,
        ]);
    }

    /**
     * Add item to cart.
     */
    public function add(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:50',
            'sugar_level' => 'nullable|string',
            'ice_level' => 'nullable|string',
            'extra_shots' => 'nullable|integer|min:0|max:5',
            'spicy_level' => 'nullable|integer|min:0|max:8',
            'notes' => 'nullable|string|max:200',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        $sugar = $validated['sugar_level'] ?? 'Normal (100%)';
        $ice = $validated['ice_level'] ?? 'Normal Ice';
        $extraShots = (int) ($validated['extra_shots'] ?? 0);
        $spicy = (int) ($validated['spicy_level'] ?? $product->spicy_level);
        $notes = $validated['notes'] ?? '';

        // Generate a unique item key based on customizations
        $itemKey = md5("{$product->id}_{$sugar}_{$ice}_{$extraShots}_{$spicy}_{$notes}");

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$itemKey])) {
            $cart[$itemKey]['quantity'] += (int) $validated['quantity'];
        } else {
            $cart[$itemKey] = [
                'item_key' => $itemKey,
                'product_id' => $product->id,
                'name' => $product->name,
                'image_url' => $product->image_url,
                'unit_price' => (float) $product->price,
                'quantity' => (int) $validated['quantity'],
                'sugar_level' => $sugar,
                'ice_level' => $ice,
                'extra_shots' => $extraShots,
                'spicy_level' => $spicy,
                'notes' => $notes,
            ];
        }

        $request->session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => "{$product->name} berhasil ditambahkan ke keranjang!",
            'total_items' => array_sum(array_column($cart, 'quantity')),
        ]);
    }

    /**
     * Update quantity of an item in cart.
     */
    public function updateQuantity(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'item_key' => 'required|string',
            'delta' => 'required|integer',
        ]);

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$validated['item_key']])) {
            $newQty = $cart[$validated['item_key']]['quantity'] + $validated['delta'];
            if ($newQty <= 0) {
                unset($cart[$validated['item_key']]);
            } else {
                $cart[$validated['item_key']]['quantity'] = min(50, $newQty);
            }
            $request->session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Remove single item from cart.
     */
    public function remove(Request $request): JsonResponse
    {
        $itemKey = $request->input('item_key');
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$itemKey])) {
            unset($cart[$itemKey]);
            $request->session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Clear the whole cart.
     */
    public function clear(Request $request): JsonResponse
    {
        $request->session()->forget(['cart', 'voucher']);

        return response()->json(['success' => true]);
    }

    /**
     * Apply voucher to session.
     */
    public function applyVoucher(Request $request): JsonResponse
    {
        $code = strtoupper(trim($request->input('code', '')));
        $promo = Promotion::where('code', $code)->where('is_active', true)->first();

        if (! $promo) {
            return response()->json(['success' => false, 'message' => 'Voucher tidak ditemukan.'], 422);
        }

        $request->session()->put('voucher', [
            'code' => $promo->code,
            'title' => $promo->title,
            'discount_type' => $promo->discount_type,
            'discount_amount' => $promo->discount_amount,
            'min_spend' => $promo->min_spend,
            'max_discount' => $promo->max_discount,
        ]);

        return response()->json([
            'success' => true,
            'message' => "Voucher {$promo->code} berhasil diterapkan!",
        ]);
    }

    /**
     * Remove voucher from session.
     */
    public function removeVoucher(Request $request): JsonResponse
    {
        $request->session()->forget('voucher');

        return response()->json(['success' => true]);
    }
}
