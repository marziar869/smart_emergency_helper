<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderRequestAttempt extends Model
{
    protected $fillable = [
        'emergency_request_id',
        'provider_id',
        'area_score',
        'availability_score',
        'rating_score',
        'experience_score',
        'recommendation_score',
        'status',
        'expires_at',
        'responded_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'responded_at' => 'datetime',
    ];

    public function emergencyRequest()
    {
        return $this->belongsTo(EmergencyRequest::class);
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
}