<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePhoto extends Model
{

    protected $fillable = [
        'emergency_request_id',
        'provider_id',
        'type',
        'photo_path'
    ];



    public function emergencyRequest()
    {
        return $this->belongsTo(EmergencyRequest::class);
    }


    public function provider()
    {
        return $this->belongsTo(User::class,'provider_id');
    }

}