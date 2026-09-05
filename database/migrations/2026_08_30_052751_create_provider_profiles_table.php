<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provider_profiles', function (Blueprint $table) {
            $table->id();

            // Foreign key columns
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('service_category_id');

            // Provider information
            $table->string('area');
            $table->string('address');

            $table->unsignedInteger('experience_years')
                ->default(0);

            // Rating
            $table->decimal('rating', 3, 2)
                ->default(0.00);

            $table->unsignedInteger('total_reviews')
                ->default(0);

            // Phone verification
            $table->boolean('phone_verified')
                ->default(false);

            $table->timestamp('phone_verified_at')
                ->nullable();

            // Admin approval
            $table->enum('approval_status', [
                'pending',
                'approved',
                'rejected',
                'suspended'
            ])->default('pending');

            $table->timestamp('approved_at')
                ->nullable();

            // Provider status
            $table->boolean('is_active')
                ->default(true);

            $table->boolean('is_available')
                ->default(false);

            $table->timestamps();

            // One provider profile per user
            $table->unique('user_id');

            // Foreign Keys
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('service_category_id')
                ->references('id')
                ->on('service_categories')
                ->onDelete('restrict');

            // Provider matching index
            $table->index(
                [
                    'service_category_id',
                    'area',
                    'approval_status',
                    'is_active',
                    'is_available'
                ],
                'provider_matching_index'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provider_profiles');
    }
};