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
            $table->string('before_photo')->nullable()->after('description');
            $table->string('after_photo')->nullable()->after('before_photo');
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
