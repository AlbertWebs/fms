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
        // Update existing files with null status to 'uploaded'
        DB::table('files')
            ->whereNull('status')
            ->update(['status' => 'uploaded']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration doesn't need to be reversed
    }
};
