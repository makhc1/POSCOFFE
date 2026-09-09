<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Outlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'address',
        'phone',
        'operating_hours',
        'google_maps_url',
        'is_24_hours',
        'has_wifi',
        'has_drive_thru',
        'has_outdoor',
        'has_musholla',
        'has_colokan',
        'status',
        'image_url',
    ];

    protected $casts = [
        'is_24_hours' => 'boolean',
        'has_wifi' => 'boolean',
        'has_drive_thru' => 'boolean',
        'has_outdoor' => 'boolean',
        'has_musholla' => 'boolean',
        'has_colokan' => 'boolean',
    ];

    /**
     * Get orders assigned to this outlet.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
