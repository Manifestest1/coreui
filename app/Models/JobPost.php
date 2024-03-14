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
        'user_id'
    ];

    public function users() 
    {
        return $this->belongsToMany(User::class,'job_post_user','job_post_id','employee_id');
    }
}
