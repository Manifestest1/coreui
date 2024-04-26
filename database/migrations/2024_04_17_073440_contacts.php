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
        Schema::create('contacts', function (Blueprint $table) 
        {
            $table->id();
            $table->string('name'); 
            $table->string('email');
            $table->string('subject');
<<<<<<< HEAD
            $table->string('message'); 
=======
            $table->string('message');
>>>>>>> e4630e401b5d8b326a10c4ffa28ec9b711b283fa
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
