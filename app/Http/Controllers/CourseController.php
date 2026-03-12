<?php
namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller {
    public function index() {
        return response()->json(Course::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'code'           => 'required|string|unique:courses,code',
            'name'           => 'required|string',
            'department'     => 'required|string',
            'units'          => 'required|integer|min:1|max:6',
            'enrolled_count' => 'sometimes|integer|min:0',
        ]);
        return response()->json(Course::create($data), 201);
    }

    public function show(Course $course) { return response()->json($course); }

    public function update(Request $request, Course $course) {
        $data = $request->validate([
            'code'       => 'sometimes|string|unique:courses,code,'.$course->id,
            'name'       => 'sometimes|string',
            'department' => 'sometimes|string',
            'units'      => 'sometimes|integer',
        ]);
        $course->update($data);
        return response()->json($course);
    }

    public function destroy(Course $course) {
        $course->delete();
        return response()->json(['message' => 'Course deleted.']);
    }
}