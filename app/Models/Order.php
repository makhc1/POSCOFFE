<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_phone',
        'customer_email',
        'order_type',
        'table_number',
        'delivery_address',
        'outlet_id',
        'subtotal',
        'discount_amount',
        'tax_amount',
        'total_amount',
        'voucher_code',
        'status',
        'payment_method',
        'payment_status',
        'notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    /**
     * Get items in this order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get outlet where order was placed.
     */
    public function outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class);
    }

    /**
     * Get status label and color badge in Indonesian.
     */
    public function getStatusInfoAttribute(): array
    {
        return match ($this->status) {
            'pending' => ['label' => 'Menunggu Pembayaran', 'badge' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30', 'step' => 1],
            'brewing' => ['label' => 'Sedang Diseduh Barista', 'badge' => 'bg-pink-500/20 text-pink-400 border-pink-500/30', 'step' => 2],
            'ready' => ['label' => 'Siap Diambil / Diantar', 'badge' => 'bg-blue-500/20 text-blue-400 border-blue-500/30', 'step' => 3],
            'completed' => ['label' => 'Pesanan Selesai', 'badge' => 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30', 'step' => 4],
            'cancelled' => ['label' => 'Dibatalkan', 'badge' => 'bg-red-500/20 text-red-400 border-red-500/30', 'step' => 0],
            default => ['label' => 'Diproses', 'badge' => 'bg-gray-500/20 text-gray-400 border-gray-500/30', 'step' => 1],
        };
    }
}
