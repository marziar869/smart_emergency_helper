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
            if (!Schema::hasColumn('emergency_requests', 'before_photo')) {
                $table->string('before_photo')->nullable();
            }
            if (!Schema::hasColumn('emergency_requests', 'after_photo')) {
                $table->string('after_photo')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emergency_requests', function (Blueprint $table) {
            $table->dropColumn(['before_photo', 'after_photo']);
        });
    }
};
