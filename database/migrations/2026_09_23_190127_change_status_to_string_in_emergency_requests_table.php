<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE emergency_requests DROP CONSTRAINT IF EXISTS emergency_requests_status_check;');
        DB::statement('ALTER TABLE emergency_requests ALTER COLUMN status TYPE VARCHAR(50);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
