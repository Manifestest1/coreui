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
        Schema::table('employees', function (Blueprint $table) {
            $table->string('company_name')->nullable();
            $table->string('responsibilities_and_achievements')->nullable();
            $table->string('Degree')->nullable();
            $table->string('university_or_collegeName')->nullable();
            $table->string('graduation_date')->nullable();
            $table->string('coursework_or_academic_achievements')->nullable();
            $table->string('project_title')->nullable();
            $table->string('brief_description')->nullable();
            $table->string('role_and_contributions')->nullable();
            $table->string('Technologies_used')->nullable();
            $table->string('dates_of_employment')->nullable();  
            $table->string('location')->nullable();              
            $table->string('job_title')->nullable();
            $table->string('professional_summary')->nullable();
            $table->string('linkedIn_profile')->nullable();
            $table->string('proficiency_level_of_language')->nullable();
            $table->string('References')->nullable();
            $table->string('issuing_organization')->nullable();
            $table->string('certification_name')->nullable();
            $table->string('date_of_certification')->nullable();

            $table->foreign('employer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn([
                'company_name',
                'responsibilities_and_achievements',
                'Degree',
                'university_or_collegeName',
                'graduation_date',
                'coursework_or_academic_achievements',
                'project_title',
                'brief_description',
                'role_and_contributions',
                'Technologies_used',
                'dates_of_employment',
                'location',
                'job_title',
                'professional_summary',
                'linkedIn_profile',
                'proficiency_level_of_language',
                'References',
                'issuing_organization',
                'certification_name',
                'date_of_certification',
            ]);
        });
    }
};
