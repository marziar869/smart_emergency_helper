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
            $table->decimal('amount', 10, 2)->default(500.00)->after('description');
            $table->string('payment_method')->default('Cash')->after('amount');
            $table->string('payment_status')->default('pending')->after('payment_method');
            $table->timestamp('paid_at')->nullable()->after('completed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emergency_requests', function (Blueprint $table) {
            $table->dropColumn(['amount', 'payment_method', 'payment_status', 'paid_at']);
        });
    }
};
