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
        Schema::table('clients', function (Blueprint $table) {
            // Company Details
            $table->string('company_name')->nullable()->after('name');
            $table->text('company_address')->nullable()->after('company_name');
            $table->string('company_website')->nullable()->after('company_address');
            $table->string('company_registration_number')->nullable()->after('company_website');
            
            // Contact Person Details
            $table->string('contact_name')->nullable()->after('company_registration_number');
            $table->string('contact_email')->nullable()->after('contact_name');
            $table->string('contact_phone')->nullable()->after('contact_email');
            $table->string('contact_position')->nullable()->after('contact_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'company_name',
                'company_address',
                'company_website',
                'company_registration_number',
                'contact_name',
                'contact_email',
                'contact_phone',
                'contact_position',
            ]);
        });
    }
};
