<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
       Schema::create('emergency_request_logs', function(Blueprint $table){

    $table->id();


    $table->foreignId(
        'emergency_request_id'
    )
    ->constrained()
    ->cascadeOnDelete();



    $table->foreignId(
        'provider_id'
    )
    ->nullable()
    ->constrained('users');



    $table->string(
        'status'
    );


    $table->text(
        'note'
    )
    ->nullable();


    $table->timestamps();

});
    }
};
