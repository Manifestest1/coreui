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
        'marital_status',
        'city',
        'state',
        'country',
        'pincode',
        'gender',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'employee_id','id'); 
    }
}
