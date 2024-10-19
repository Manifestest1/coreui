<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_image',
        'company_name',
        'role_of_employee',
        'used_technology',
        'working_from',
        'working_to',
        'location',
        'responsibilities'
    ];

    public function experienceOf() 
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
