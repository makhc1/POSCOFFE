<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'sugar_level',
        'ice_level',
        'extra_shots',
        'spicy_level',
        'notes',
        'subtotal',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'quantity' => 'integer',
        'extra_shots' => 'integer',
        'spicy_level' => 'integer',
    ];

    /**
     * Get the order that owns this item.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product details.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
