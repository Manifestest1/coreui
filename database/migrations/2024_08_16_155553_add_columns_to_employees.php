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
            // Check and add columns only if they don't exist
            if (!Schema::hasColumn('employees', 'company_name')) {
                $table->string('company_name')->nullable();
            }
            if (!Schema::hasColumn('employees', 'responsibilities_and_achievements')) {
                $table->string('responsibilities_and_achievements')->nullable();
            }
            if (!Schema::hasColumn('employees', 'coursework_or_academic_achievements')) {
                $table->string('coursework_or_academic_achievements')->nullable();
            }
            if (!Schema::hasColumn('employees', 'project_title')) {
                $table->string('project_title')->nullable();
            }
            if (!Schema::hasColumn('employees', 'brief_description')) {
                $table->string('brief_description')->nullable();
            }
            if (!Schema::hasColumn('employees', 'role_of_employee')) {
                $table->string('role_of_employee')->nullable();
            }
            if (!Schema::hasColumn('employees', 'Technologies_used')) {
                $table->string('technologies_used')->nullable();
            }
            if (!Schema::hasColumn('employees', 'dates_of_employment')) {
                $table->string('dates_of_employment')->nullable();
            }
            if (!Schema::hasColumn('employees', 'location')) {
                $table->string('location')->nullable();
            }
            if (!Schema::hasColumn('employees', 'job_title')) {
                $table->string('job_title')->nullable();
            }
            if (!Schema::hasColumn('employees', 'professional_summary')) {
                $table->string('professional_summary')->nullable();
            }
            if (!Schema::hasColumn('employees', 'linkedIn_profile')) {
                $table->string('linkedIn_profile')->nullable();
            }
            if (!Schema::hasColumn('employees', 'proficiency_level_of_language')) {
                $table->string('proficiency_level_of_language')->nullable();
            }
            if (!Schema::hasColumn('employees', 'references')) {
                $table->string('references')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn([
                'company_name',
                'responsibilities_and_achievements',
                'degree',
                'university_or_collegeName',
                'graduation_date',
                'coursework_or_academic_achievements',
                'project_title',
                'brief_description',
                'role_of_employee',
                'technologies_used',
                'dates_of_employment',
                'location',
                'job_title',
                'professional_summary',
                'linkedIn_profile',
                'proficiency_level_of_language',
                'references',
                'issuing_organization',
                'certification_name',
                'date_of_certification',
            ]);
        });
    }
};
