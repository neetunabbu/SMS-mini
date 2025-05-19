<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // List all students
    public function index(Request $request)
    {
        $query = Student::with(['teacher', 'schoolClass'])->latest();

        // Paginate the results and preserve query parameters
        $students = $query->paginate(10)->appends([
            'search' => $request->input('search'),
            'role' => $request->input('role'),
        ]);

        return view('admin.students.index', compact('students'));
    }

    // Show form to create a new student
    public function create()
    {
        $teachers = Teacher::all();
        $classes  = SchoolClass::all();

        return view('admin.students.create', compact('teachers', 'classes'));
    }

    // Store a new student
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:students,email',
            'class_id'    => 'required|exists:school_classes,id',
            'roll_number' => 'required|string|max:50',
            'teacher_id'  => 'required|exists:teachers,id',
        ]);

        Student::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'user_id'     => auth()->id(),
            'class_id'    => $request->class_id,
            'roll_number' => $request->roll_number,
            'teacher_id'  => $request->teacher_id,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');
    }

    // Show student details
    public function show(Student $student)
    {
        return view('admin.students.show', compact('student'));
    }

    // Show form to edit a student
    public function edit(Student $student)
    {
        $teachers = Teacher::all();
        $classes  = SchoolClass::all();

        return view('admin.students.edit', compact('student', 'teachers', 'classes'));
    }

    // Update student details
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:students,email,' . $student->id,
            'class_id'    => 'required|exists:school_classes,id',
            'roll_number' => 'required|string|max:50',
            'teacher_id'  => 'required|exists:teachers,id',
        ]);

        $student->update($request->only([
            'name',
            'email',
            'class_id',
            'roll_number',
            'teacher_id',
        ]));

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }

    // Delete a student
    public function destroy(Student $student)
    {
        // Optional: if student has dependent records (like marks/attendance), check before delete
        // if ($student->attendances()->count() > 0) {
        //     return redirect()->route('admin.students.index')->withErrors('Cannot delete student with attendance records.');
        // }

        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }
}