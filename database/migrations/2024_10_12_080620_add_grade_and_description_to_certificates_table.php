<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('certificates', function (Blueprint $table) {
            // Add the grade and description columns
            $table->string('grade')->nullable(); 
            $table->text('description')->nullable()->after('grade'); 
        });
    }

    public function down()
    {
        Schema::table('certificates', function (Blueprint $table) {
            // Drop the grade and description columns
            $table->dropColumn(['grade', 'description']);
        });
    }
       
};
