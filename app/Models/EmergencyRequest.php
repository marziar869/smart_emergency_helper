<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'arrival_pin_verified_at' => 'datetime',
        'completion_pin_verified_at' => 'datetime',
        'before_photo_uploaded_at' => 'datetime',
        'after_photo_uploaded_at' => 'datetime',
        'on_the_way_at' => 'datetime',
        'assigned_at' => 'datetime',
        'accepted_at' => 'datetime',
        'arrived_at' => 'datetime',
        'work_started_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'paid_at' => 'datetime',
        'is_rated' => 'boolean',
        'amount' => 'decimal:2',
    ];

    public function getCurrentStepAttribute(): int
    {
        $map = [
            'pending' => 0,
            'accepted' => 1,
            'provider_assigned' => 1,
            'on_the_way' => 2,
            'provider_on_way' => 2,
            'arrival_pin' => 3,
            'arrival_pin_required' => 3,
            'arrived' => 3,
            'completion_pin' => 4,
            'completion_pin_required' => 4,
            'completed' => 5,
            'rating_review' => 5,
        ];
        return $map[$this->status] ?? 0;
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function assignedProvider()
    {
        return $this->belongsTo(User::class, 'assigned_provider_id');
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'assigned_provider_id');
    }

    public function serviceCategory()
    {
        return $this->belongsTo(
            ServiceCategory::class,
            'service_category_id'
        );
    }
}