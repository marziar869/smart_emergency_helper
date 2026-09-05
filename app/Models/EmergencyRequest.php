<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

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
}