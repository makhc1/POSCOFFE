<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_handle',
        'avatar_url',
        'rating',
        'comment',
        'favorite_menu',
        'outlet_name',
        'is_featured',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_featured' => 'boolean',
    ];
}
