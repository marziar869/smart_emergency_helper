<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ServicePhoto;


class EmergencyRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'customer_id',
        'service_category_id',
        'priority',
        'area',
        'address',
        'description',
        'assigned_provider_id',
        'status',
        'assigned_at',
        'accepted_at',
        'on_the_way_at',
        'arrived_at',
        'work_started_at',
        'completed_at',
        'arrival_pin',
        'arrival_pin_verified_at',
        'before_photo',
        'before_photo_path',
        'before_photo_uploaded_at',
        'after_photo',
        'after_photo_path',
        'after_photo_uploaded_at',
        'completion_pin',
        'completion_pin_verified_at',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'accepted_at' => 'datetime',
        'on_the_way_at' => 'datetime',
        'arrived_at' => 'datetime',
        'work_started_at' => 'datetime',
        'completed_at' => 'datetime',
        'arrival_pin_verified_at' => 'datetime',
        'before_photo_uploaded_at' => 'datetime',
        'after_photo_uploaded_at' => 'datetime',
        'completion_pin_verified_at' => 'datetime',
    ];

    public function photos()
{
    return $this->hasMany(ServicePhoto::class);
}
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function assignedProvider()
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

    public function attempts()
    {
        return $this->hasMany(
            ProviderRequestAttempt::class,
            'emergency_request_id'
        );
    }
}