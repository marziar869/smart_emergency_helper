<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('service_photos', function (Blueprint $table) {

    $table->id();


    $table->foreignId(
        'emergency_request_id'
    )
    ->constrained()
    ->cascadeOnDelete();



    $table->foreignId(
        'provider_id'
    )
    ->constrained('users');



    $table->enum(
        'type',
        [
            'before',
            'after'
        ]
    );



    $table->string(
        'photo_path'
    );



    $table->timestamps();

});
    }
    
};
