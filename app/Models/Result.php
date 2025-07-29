<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    // Add fillable if needed
    protected $fillable = ['student_id', 'course_id', 'score', 'letter_grade'];

    // Relationship: Result belongs to one Student
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // Relationship: Result belongs to one Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
