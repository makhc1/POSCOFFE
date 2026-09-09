<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'original_price',
        'image_url',
        'is_best_seller',
        'is_spicy_or_bold',
        'caffeine_level',
        'spicy_level',
        'badge',
        'is_available',
        'rating',
        'review_count',
        'serving_type',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'is_best_seller' => 'boolean',
        'is_spicy_or_bold' => 'boolean',
        'is_available' => 'boolean',
        'caffeine_level' => 'integer',
        'spicy_level' => 'integer',
        'rating' => 'float',
        'review_count' => 'integer',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the order items for the product.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the formatted price in IDR rupiah.
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp '.number_format($this->price, 0, ',', '.');
    }

    /**
     * Get the formatted original price in IDR rupiah if available.
     */
    public function getFormattedOriginalPriceAttribute(): ?string
    {
        if ($this->original_price) {
            return 'Rp '.number_format($this->original_price, 0, ',', '.');
        }

        return null;
    }

    /**
     * Get coffee/spicy level text indicator.
     */
    public function getLevelNameAttribute(): string
    {
        if ($this->caffeine_level > 0) {
            return match (true) {
                $this->caffeine_level <= 2 => 'Level Manja (Mild)',
                $this->caffeine_level <= 5 => 'Level Hompimpa (Medium)',
                $this->caffeine_level <= 8 => 'Level Iblis (Strong)',
                default => 'Level Setan (Extra Shot)',
            };
        }

        if ($this->spicy_level > 0) {
            return match (true) {
                $this->spicy_level <= 2 => 'Level Manja (Gurih)',
                $this->spicy_level <= 5 => 'Level Hompimpa (Pedas Sedang)',
                default => 'Level Setan (Pedas Gila)',
            };
        }

        return 'Non-Coffee / Manis Segar';
    }
}
