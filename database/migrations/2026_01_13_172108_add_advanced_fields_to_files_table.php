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
        Schema::table('files', function (Blueprint $table) {
            $table->enum('status', ['uploaded', 'pending_review', 'approved', 'needs_correction', 'archived'])->default('uploaded')->after('version');
            $table->boolean('is_locked')->default(false)->after('status');
            $table->string('file_hash', 64)->nullable()->after('is_locked');
            $table->timestamp('archived_at')->nullable()->after('file_hash');
            
            $table->index('status');
            $table->index('is_locked');
            $table->index('file_hash');
            $table->index('archived_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['is_locked']);
            $table->dropIndex(['file_hash']);
            $table->dropIndex(['archived_at']);
            
            $table->dropColumn(['status', 'is_locked', 'file_hash', 'archived_at']);
        });
    }
};
