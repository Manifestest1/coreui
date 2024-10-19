<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'employee_id',
        'project_name',
        'company_image',
        'brief_description',
        'role_of_employee',
        'technologies_used',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'employee_id','id'); 
    }
}
