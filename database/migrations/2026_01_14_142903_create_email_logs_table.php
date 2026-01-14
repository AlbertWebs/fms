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
        Schema::create('email_logs', function (Blueprint $table) {
            $table->id();
            $table->string('recipient_email');
            $table->string('recipient_name')->nullable();
            $table->string('subject');
            $table->string('mail_class'); // The mailable class name (e.g., FileRequestMail)
            $table->enum('status', ['pending', 'sent', 'failed'])->default('pending');
            $table->text('error_message')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->string('related_model_type')->nullable(); // e.g., FileRequest, User
            $table->unsignedBigInteger('related_model_id')->nullable();
            $table->json('metadata')->nullable(); // Additional data like file request ID, etc.
            $table->timestamps();
            
            $table->index('recipient_email');
            $table->index('status');
            $table->index(['related_model_type', 'related_model_id']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_logs');
    }
};
