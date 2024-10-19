<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $table = 'certificates';

    protected $fillable = [
        'employee_id',
        'certificate_name',
        'date_of_certification',
        'issuing_organization',
        'grade',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'employee_id','id'); 
    }
}
