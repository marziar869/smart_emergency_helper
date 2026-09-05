<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderProfile extends Model
{
    protected $fillable = [
        'user_id',
        'service_category_id',
        'area',
        'address',
        'experience_years',
        'rating',
        'total_reviews',
        'phone_verified',
        'phone_verified_at',
        'approval_status',
        'approved_at',
        'is_active',
        'is_available',
    ];

    protected $casts = [
        'phone_verified' => 'boolean',
        'is_active' => 'boolean',
        'is_available' => 'boolean',
        'phone_verified_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function serviceCategory()
    {
        return $this->belongsTo(
            ServiceCategory::class,
            'service_category_id'
        );
    }
}