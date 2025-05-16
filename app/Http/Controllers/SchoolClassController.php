<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    // List all classes
    public function index()
    {
        $classes = SchoolClass::with(['students', 'teacher'])->latest()->get();

        return view('admin.school_classes.index', compact('classes'));
    }

    // Show form to create a new class
    public function create()
    {
        $teachers = User::where('role', 'teacher')->get();

        return view('admin.school_classes.create', compact('teachers'));
    }

    // Store a new class
    public function store(Request $request)
    {
        $request->validate([
            'class_name'    => 'required|string|max:255',
            'subject'       => 'required|string|max:255',
            'teacher_id'    => 'required|exists:users,id',
            'student_count' => 'nullable|integer|min:0',
        ]);

        SchoolClass::create([
            'class_name'    => $request->class_name,
            'subject'       => $request->subject,
            'teacher_id'    => $request->teacher_id,
            'student_count' => $request->student_count ?? 0,
        ]);

        return redirect()->route('admin.school_classes.index')->with('success', 'Class created successfully.');
    }

    // Show form to edit an existing class
    public function edit(SchoolClass $school_class)
    {
        $teachers = User::where('role', 'teacher')->get();

        return view('admin.school_classes.edit', compact('school_class', 'teachers'));
    }

    // Update class details
    public function update(Request $request, SchoolClass $school_class)
    {
        $request->validate([
            'class_name'    => 'required|string|max:255',
            'subject'       => 'required|string|max:255',
            'teacher_id'    => 'required|exists:users,id',
            'student_count' => 'nullable|integer|min:0',
        ]);

        $school_class->update([
            'class_name'    => $request->class_name,
            'subject'       => $request->subject,
            'teacher_id'    => $request->teacher_id,
            'student_count' => $request->student_count ?? 0,
        ]);

        return redirect()->route('admin.school_classes.index')->with('success', 'Class updated successfully.');
    }

    // Delete a class
    public function destroy(SchoolClass $school_class)
    {
        $school_class->delete();

        return redirect()->route('admin.school_classes.index')->with('success', 'Class deleted successfully.');
    }

    // Show details of a single class
    public function show($id)
    {
        $schoolClass = SchoolClass::with(['students', 'teacher'])->findOrFail($id);

        return view('admin.school_classes.show', compact('schoolClass'));
    }
}
