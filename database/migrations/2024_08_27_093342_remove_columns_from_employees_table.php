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
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['issuing_organization', 'certification_name', 'date_of_certification']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('issuing_organization')->nullable(); // Re-add the columns if rolling back
            $table->string('certification_name')->nullable();
            $table->string('date_of_certification')->nullable();
        });
    }
};
