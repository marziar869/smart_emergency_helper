<<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('emergency_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('emergency_requests', 'arrival_pin')) {
                $table->string('arrival_pin', 4)->nullable();
            }
            if (!Schema::hasColumn('emergency_requests', 'arrival_pin_verified_at')) {
                $table->timestamp('arrival_pin_verified_at')->nullable();
            }
            if (!Schema::hasColumn('emergency_requests', 'before_photo_path')) {
                $table->string('before_photo_path')->nullable();
            }
            if (!Schema::hasColumn('emergency_requests', 'before_photo_uploaded_at')) {
                $table->timestamp('before_photo_uploaded_at')->nullable();
            }
            if (!Schema::hasColumn('emergency_requests', 'after_photo_path')) {
                $table->string('after_photo_path')->nullable();
            }
            if (!Schema::hasColumn('emergency_requests', 'after_photo_uploaded_at')) {
                $table->timestamp('after_photo_uploaded_at')->nullable();
            }
            if (!Schema::hasColumn('emergency_requests', 'completion_pin')) {
                $table->string('completion_pin', 4)->nullable();
            }
            if (!Schema::hasColumn('emergency_requests', 'completion_pin_verified_at')) {
                $table->timestamp('completion_pin_verified_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('emergency_requests', function (Blueprint $table) {
            $table->dropColumn([
                'on_the_way_at',
                'arrival_pin',
                'arrival_pin_verified_at',
                'before_photo_path',
                'before_photo_uploaded_at',
                'after_photo_path',
                'after_photo_uploaded_at',
                'completion_pin',
                'completion_pin_verified_at',
            ]);
        });
    }
};