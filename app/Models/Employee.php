<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Employee extends Model  
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'phone',
        'current_address',
        'permanent_address', 
        'adhar_card_no',
        'qualification',
        'certifications',
        'skills',
        'working_from',
        'work_experience',
        'current_working_skill',
        'languages',
        'hobbies',
        'marriage_status',
        'city',
        'state',
        'country',
        'pincode',
        'gender',
        'company_name',
        'responsibilities_and_achievements',
        'Degree',
        'university_or_collegeName',
        'graduation_date',
        'coursework_or_academic_achievements',
        'dates_of_employment',
        'location',
        'job_title',
        'professional_summary',
        'linkedIn_profile',
        'proficiency_level_of_language',
        'References',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'employee_id','id'); 
    }
}
