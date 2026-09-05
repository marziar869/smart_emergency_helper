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
        Schema::create('provider_request_attempts', function (Blueprint $table) {
            $table->id();

            // Which emergency request
            $table->foreignId('emergency_request_id')
                ->constrained('emergency_requests')
                ->cascadeOnDelete();

            // Which provider received the request
            $table->foreignId('provider_id')
                ->constrained('users')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Recommendation Scores
            |--------------------------------------------------------------------------
            */

            // Area Match = 40%
            $table->decimal('area_score', 5, 2)
                ->default(0);

            // Availability = 25%
            $table->decimal('availability_score', 5, 2)
                ->default(0);

            // Rating = 20%
            $table->decimal('rating_score', 5, 2)
                ->default(0);

            // Experience = 15%
            $table->decimal('experience_score', 5, 2)
                ->default(0);

            // Total recommendation score
            $table->decimal('recommendation_score', 5, 2)
                ->default(0);

            /*
            |--------------------------------------------------------------------------
            | Provider Response
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'pending',
                'accepted',
                'rejected',
                'expired'
            ])->default('pending');

            // When request was sent to provider
            $table->timestamp('sent_at')->nullable();

            // Provider response deadline
            $table->timestamp('expires_at')->nullable();

            // When provider actually responded
            $table->timestamp('responded_at')->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index([
                'emergency_request_id',
                'status'
            ], 'request_attempt_status_index');

            $table->index([
                'provider_id',
                'status'
            ], 'provider_attempt_status_index');

            // Same request shouldn't be sent twice to same provider
            $table->unique([
                'emergency_request_id',
                'provider_id'
            ], 'unique_request_provider_attempt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provider_request_attempts');
    }
};