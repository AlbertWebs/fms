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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('restrict');
            $table->string('original_name');
            $table->string('stored_name');
            $table->string('s3_path');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size')->default(0);
            $table->string('financial_year', 9);
            $table->unsignedInteger('version')->default(1);
            $table->foreignId('parent_file_id')->nullable()->constrained('files')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
            
            $table->index(['client_id', 'financial_year', 'category_id']);
            $table->index('parent_file_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
