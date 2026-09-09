<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnershipInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'full_name',
        'email',
        'phone',
        'city',
        'location_plan_or_position',
        'budget_or_experience',
        'message',
        'status',
    ];
}
