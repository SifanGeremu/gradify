<?php

namespace App\Http\Controllers;

use App\Models\course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // List all courses
    public function index()
    {
        $courses = course::all();
        return response()->json($courses);
    }

    // Create a new course
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $course = course::create($validated);
        return response()->json(['message' => 'Course created successfully', 'course' => $course], 201);
    }

    // Show one course
    public function show($id)
    {
        $course = course::findOrFail($id);
        return response()->json($course);
    }

    // Update course
    public function update(Request $request, $id)
    {
        $course = course::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $course->update($validated);
        return response()->json(['message' => 'Course updated successfully']);
    }

    // Delete course
    public function destroy($id)
    {
        $course = course::findOrFail($id);
        $course->delete();
        return response()->json(['message' => 'Course deleted successfully']);
    }
}
