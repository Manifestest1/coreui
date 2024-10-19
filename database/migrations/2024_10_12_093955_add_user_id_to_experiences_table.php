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
        Schema::table('experiences', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); 
            $table->string('company_image')->nullable(); 
            $table->string('company_name'); 
            $table->string('role_of_employee'); 
            $table->string('used_technology')->nullable(); 
            $table->date('working_from'); 
            $table->date('working_to')->nullable();
            $table->string('location')->nullable();
            $table->text('responsibilities')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            Schema::dropIfExists('experiences');
        });
    }
};
