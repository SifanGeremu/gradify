<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    // Add this:
    protected $fillable = [
        'course_code',
        'course_name',
        'credit_hours',
    ];
}
