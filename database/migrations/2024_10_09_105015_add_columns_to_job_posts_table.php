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
        Schema::table('job_posts', function (Blueprint $table) {
            $table->string('company_type')->nullable(); // Add nullable if this field is optional
            $table->string('job_type')->nullable();
            $table->string('posted_within')->nullable();
            $table->string('department')->nullable();
            $table->string('duration')->nullable();
            $table->string('education')->nullable();
            $table->string('industry')->nullable();
            $table->decimal('salary', 10, 2)->nullable(); // Use decimal for salary with 10 digits, 2 decimal places
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_posts', function (Blueprint $table) {
            $table->dropColumn(['company_type', 'job_type', 'posted_within', 'department', 'duration', 'education', 'industry', 'salary']);
        });
    }
};
