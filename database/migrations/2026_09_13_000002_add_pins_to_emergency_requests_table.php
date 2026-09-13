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
        Schema::table('emergency_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('emergency_requests', 'arrival_pin')) {
                $table->string('arrival_pin')->nullable();
            }
            if (!Schema::hasColumn('emergency_requests', 'completion_pin')) {
                $table->string('completion_pin')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emergency_requests', function (Blueprint $table) {
            $table->dropColumn(['arrival_pin', 'completion_pin']);
        });
    }
};
