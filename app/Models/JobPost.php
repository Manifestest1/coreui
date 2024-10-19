<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model; 
use App\Models\User;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'title',
        'description',
        'location',
        'user_id',
        'company_type',
        'job_type',
        'posted_within',
        'department',
        'duration',
        'education',
        'industry',
        'salary',
    ];

    public function users() 
    {
        return $this->belongsToMany(User::class,'job_post_user','job_post_id','employee_id');
    }

    public function postedby() 
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
