<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'description',
        'discount_type',
        'discount_amount',
        'min_spend',
        'max_discount',
        'badge_tag',
        'banner_gradient',
        'expires_at',
        'is_active',
    ];

    protected $casts = [
        'discount_amount' => 'decimal:2',
        'min_spend' => 'decimal:2',
        'max_discount' => 'decimal:2',
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Calculate discount for a given subtotal.
     */
    public function calculateDiscount(float $subtotal): float
    {
        if ($subtotal < $this->min_spend) {
            return 0.0;
        }

        if ($this->discount_type === 'percentage') {
            $discount = ($this->discount_amount / 100) * $subtotal;
            if ($this->max_discount && $discount > $this->max_discount) {
                $discount = (float) $this->max_discount;
            }

            return round($discount);
        }

        return min((float) $this->discount_amount, $subtotal);
    }
}
