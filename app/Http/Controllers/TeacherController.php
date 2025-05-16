<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;

class TeacherController extends Controller
{
    // List all teachers
    public function index()
    {
        $teachers = Teacher::with('students', 'user')->latest()->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    // Show form to create a new teacher
    public function create()
    {
        $users = User::where('role', 'teacher')
                     ->whereDoesntHave('teacher') // Only users not already linked to a teacher profile
                     ->get();

        return view('admin.teachers.create', compact('users'));
    }

    // Store a new teacher in the database
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:teachers,email',
            'phone_number' => 'nullable|string|max:20',
            'user_id'      => 'required|exists:users,id|unique:teachers,user_id',
        ]);

        Teacher::create($request->only(['name', 'email', 'phone_number', 'user_id']));

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher added successfully.');
    }

    // Display a specific teacher and their students
    public function show(Teacher $teacher)
    {
        // Use route model binding instead of findOrFail
        return view('admin.teachers.show', compact('teacher'));
    }

    // Show the edit form
    public function edit(Teacher $teacher)
    {
        // Fetch users: teachers who either don't have a profile, or the one linked to this profile (to avoid unique constraint issue during edit)
        $users = User::where('role', 'teacher')
                     ->where(function ($query) use ($teacher) {
                         $query->whereDoesntHave('teacher')
                               ->orWhere('id', $teacher->user_id);
                     })->get();

        return view('admin.teachers.edit', compact('teacher', 'users'));
    }

    // Update teacher details
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:teachers,email,' . $teacher->id, // Allow current teacher's email
            'phone_number' => 'nullable|string|max:20',
            'user_id'      => 'required|exists:users,id|unique:teachers,user_id,' . $teacher->id, // Allow current teacher's user_id
        ]);

        $teacher->update($request->only(['name', 'email', 'phone_number', 'user_id']));

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully.');
    }

    // Delete teacher
    public function destroy(Teacher $teacher)
    {
        // If teacher has students linked, notify user or prevent deletion
        if ($teacher->students->count() > 0) {
            return redirect()->route('admin.teachers.index')->withErrors('Cannot delete teacher with linked students.');
        }

        $teacher->delete();

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
