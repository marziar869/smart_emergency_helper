<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('emergency_requests', function (Blueprint $table) {
            $table->id();

            // Public request ID, example: REQ-490436
            $table->string('reference')->unique();

            // Customer who created the request
            $table->foreignId('customer_id')
                ->constrained('users')
                ->restrictOnDelete();

            // Ambulance / Electrician / Plumber etc.
            $table->foreignId('service_category_id')
                ->constrained('service_categories')
                ->restrictOnDelete();

            // Emergency priority
            $table->enum('priority', [
                'Critical',
                'High',
                'Medium',
                'Normal'
            ]);

            // Customer location
            $table->string('area');

            $table->string('address');

            // Customer's problem details
            $table->text('description');

            // Provider finally assigned to this request
            $table->foreignId('assigned_provider_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Complete request lifecycle
           $table->enum('status', [
    'pending',
    'accepted',
    'on_the_way',
    'arrival_pin_required',
    'arrived',
    'before_photo',
    'working',
    'after_photo',
    'completion_pin_required',
    'completed',
    'rating_review',
    'cancelled'
])
    ->default('pending');
            // Important timestamps
            $table->timestamp('assigned_at')->nullable();

            $table->timestamp('accepted_at')->nullable();

            $table->timestamp('arrived_at')->nullable();

            $table->timestamp('work_started_at')->nullable();

            $table->timestamp('completed_at')->nullable();

            $table->timestamp('cancelled_at')->nullable();

            $table->timestamps();

            // Faster searching/filtering
            $table->index([
                'service_category_id',
                'area',
                'status'
            ], 'emergency_matching_index');

            $table->index([
                'customer_id',
                'status'
            ], 'customer_request_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_requests');
    }
};