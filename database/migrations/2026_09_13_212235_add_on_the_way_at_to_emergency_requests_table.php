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
            if (!Schema::hasColumn('emergency_requests', 'on_the_way_at')) {
                $table->timestamp('on_the_way_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emergency_requests', function (Blueprint $table) {
            if (Schema::hasColumn('emergency_requests', 'on_the_way_at')) {
                $table->dropColumn('on_the_way_at');
            }
        });
    }
};
