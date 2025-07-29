<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    // ✅ Method to get all students and courses
    public function getStudentsCourses()
    {
        $students = Student::all(); // fetch all students
        $courses = Course::all();   // fetch all courses

        return response()->json([
            'students' => $students,
            'courses' => $courses
        ]);
    }

  
   public function store(Request $request)
{
    // Validate input
    $validated = $request->validate([
        'student_id' => 'required|exists:students,id',
        'course_id'  => 'required|exists:courses,id',
        'score'      => 'required|numeric|min:0|max:100',
    ]);

    // Calculate letter grade
    $score = $validated['score'];
    $letterGrade = $this->calculateLetterGrade($score);

    // Save result
    $result = Result::create([
        'student_id'   => $validated['student_id'],
        'course_id'    => $validated['course_id'],
        'score'        => $score,
        'letter_grade' => $letterGrade,
    ]);

    // Return success message with saved result
    return response()->json([
        'message' => 'Result saved successfully!',
        'result'  => $result
    ], 201);
}

    
    private function calculateLetterGrade($score)
    {
        if ($score >= 90) return 'A';
        if ($score >= 80) return 'B';
        if ($score >= 70) return 'C';
        if ($score >= 60) return 'D';
        return 'F';
    }
    public function index()
{
    // Get all results with related student and course data
    $results = Result::with(['student', 'course'])->get();

    return response()->json($results);
}

}
