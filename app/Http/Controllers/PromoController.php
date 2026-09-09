<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    /**
     * Display active promotions & vouchers.
     */
    public function index(): View
    {
        $promotions = Promotion::where('is_active', true)->orderBy('id', 'asc')->get();

        return view('promo.index', compact('promotions'));
    }

    /**
     * Validate voucher code via AJAX.
     */
    public function validateCode(Request $request): JsonResponse
    {
        $code = strtoupper(trim($request->input('code', '')));
        $subtotal = (float) $request->input('subtotal', 0);

        $promotion = Promotion::where('code', $code)
            ->where('is_active', true)
            ->first();

        if (! $promotion) {
            return response()->json([
                'valid' => false,
                'message' => 'Kode voucher tidak valid atau sudah kedaluwarsa.',
            ], 422);
        }

        if ($subtotal < $promotion->min_spend) {
            return response()->json([
                'valid' => false,
                'message' => 'Minimal belanja untuk voucher ini adalah Rp '.number_format($promotion->min_spend, 0, ',', '.'),
            ], 422);
        }

        $discount = $promotion->calculateDiscount($subtotal);

        return response()->json([
            'valid' => true,
            'code' => $promotion->code,
            'title' => $promotion->title,
            'discount' => $discount,
            'formatted_discount' => 'Rp '.number_format($discount, 0, ',', '.'),
            'message' => 'Voucher berhasil digunakan! Hemat '.'Rp '.number_format($discount, 0, ',', '.'),
        ]);
    }
}
