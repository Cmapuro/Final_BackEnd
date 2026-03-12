<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller {
    public function index(Request $request) {
        $query = Student::query();
        if ($request->has('search')) {
            $s = $request->search;
            $query->where('name','like',"%$s%")->orWhere('email','like',"%$s%");
        }
        if ($request->has('course'))     $query->where('course', $request->course);
        if ($request->has('year_level')) $query->where('year_level', $request->year_level);
        return response()->json($query->paginate(20));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name'           => 'required|string',
            'email'          => 'required|email|unique:students,email',
            'gender'         => 'required|in:Male,Female',
            'course'         => 'required|string',
            'year_level'     => 'required|integer|min:1|max:4',
            'address'        => 'required|string',
            'birthdate'      => 'required|date',
            'contact_number' => 'required|string',
        ]);
        return response()->json(Student::create($data), 201);
    }

    public function show(Student $student) {
        return response()->json($student);
    }

    public function update(Request $request, Student $student) {
        $data = $request->validate([
            'name'           => 'sometimes|string',
            'email'          => 'sometimes|email|unique:students,email,'.$student->id,
            'gender'         => 'sometimes|in:Male,Female',
            'course'         => 'sometimes|string',
            'year_level'     => 'sometimes|integer|min:1|max:4',
            'address'        => 'sometimes|string',
            'birthdate'      => 'sometimes|date',
            'contact_number' => 'sometimes|string',
        ]);
        $student->update($data);
        return response()->json($student);
    }

    public function destroy(Student $student) {
        $student->delete();
        return response()->json(['message' => 'Student deleted.']);
    }
}