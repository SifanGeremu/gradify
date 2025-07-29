<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;
use App\Models\Result;

class StudentController extends Controller
{
    // List all students
    public function index()
    {
        $students = student::all();
        return response()->json($students);
    }

    // Create new student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $student = student::create($validated);
        return response()->json(['message' => 'Student created successfully', 'student' => $student], 201);
    }

    // Show single student with GPA
    public function show($id)
    {
        $student = student::with('results')->findOrFail($id);

        $gpa = $this->calculateGPA($student);
        return response()->json([
            'student' => $student,
            'gpa' => $gpa
        ]);
    }

    // Update student info
    public function update(Request $request, $id)
    {
        $student = student::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $student->update($validated);
        return response()->json(['message' => 'Student updated successfully']);
    }

    // Delete student
    public function destroy($id)
    {
        $student = student::findOrFail($id);
        $student->delete();
        return response()->json(['message' => 'Student deleted']);
    }

    // Calculate GPA for student
    private function calculateGPA($student)
    {
        $gradePoints = [
            'A' => 4.0,
            'B' => 3.0,
            'C' => 2.0,
            'D' => 1.0,
            'F' => 0.0,
        ];

        $results = $student->results;
        if ($results->isEmpty()) {
            return 0.0;
        }

        $totalPoints = 0;
        foreach ($results as $result) {
            $totalPoints += $gradePoints[$result->letter_grade];
        }

        return round($totalPoints / count($results), 2);
    }
}
