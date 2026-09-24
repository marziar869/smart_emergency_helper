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
            $table->unsignedTinyInteger('rating')->nullable()->after('paid_at');
            $table->text('rating_comment')->nullable()->after('rating');
            $table->boolean('is_rated')->default(false)->after('rating_comment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emergency_requests', function (Blueprint $table) {
            $table->dropColumn(['rating', 'rating_comment', 'is_rated']);
        });
    }
};
