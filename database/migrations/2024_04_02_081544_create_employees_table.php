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
        Schema::create('employees', function (Blueprint $table) 
        {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('phone')->nullable();
            $table->string('current_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('adhar_card_no')->nullable();

            $table->string('qualification')->nullable();
            $table->string('certifications')->nullable();
            $table->string('skills')->nullable();
            $table->string('working_from')->nullable();
            $table->string('work_experience')->nullable();
            $table->string('current_working_skill')->nullable();
            $table->string('languages')->nullable();
            $table->string('hobbies')->nullable();
            $table->unsignedTinyInteger('marital_status')->nullable();

            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('pincode')->nullable();

            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
