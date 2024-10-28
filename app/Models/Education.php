<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';
    
    protected $fillable = [
        'institution_names',
        'course',
        'from_year',
        'to_year',
        'grading',
        'description',
        'education_id'
    ];

    public function educationOf() 
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
