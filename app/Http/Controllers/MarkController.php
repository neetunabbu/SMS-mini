<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Student;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MarkController extends Controller
{
    // List all marks
    public function index() {
        $marks = Mark::with('student', 'schoolClass')->orderBy('created_at', 'desc')->get();
        return view('admin.marks.index', compact('marks'));
    }
    

    // Show form to create a new mark
    public function create()
    {
        $students = Student::all();
        $classes = SchoolClass::all();

        return view('admin.marks.create', compact('students', 'classes'));
    }

    // Store a new mark
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'     => 'required|exists:students,id',
            'class_id'       => 'required|exists:school_classes,id',
            'subject'        => 'required|string|max:255',
            'marks_obtained' => 'required|integer',
            'max_marks'      => 'required|integer',
            'exam_type'      => 'required|string|max:255',
        ]);

        try {
            Mark::create($validated);

            return redirect()->route('admin.marks.index')->with('success', 'Mark added successfully.');
        } catch (\Exception $e) {
            Log::error("Error saving mark: " . $e->getMessage());

            return back()->with('error', 'Failed to save mark. Please try again.');
        }
    }

    // Show form to edit a mark
    public function edit(Mark $mark)
    {
        $students = Student::all();
        $classes  = SchoolClass::all();

        return view('admin.marks.edit', compact('mark', 'students', 'classes'));
    }

    // Update an existing mark
    public function update(Request $request, Mark $mark)
    {
        $validated = $request->validate([
            'student_id'     => 'required|exists:students,id',
            'class_id'       => 'required|exists:school_classes,id',
            'subject'        => 'required|string|max:255',
            'marks_obtained' => 'required|integer',
            'max_marks'      => 'required|integer',
            'exam_type'      => 'required|string|max:255',
        ]);

        try {
            $mark->update($validated);

            return redirect()->route('admin.marks.index')->with('success', 'Mark updated successfully.');
        } catch (\Exception $e) {
            Log::error("Error updating mark: " . $e->getMessage());

            return back()->with('error', 'Failed to update mark. Please try again.');
        }
    }

    // Delete a mark
    public function destroy(Mark $mark)
    {
        try {
            $mark->delete();

            return redirect()->route('admin.marks.index')->with('success', 'Mark deleted successfully.');
        } catch (\Exception $e) {
            Log::error("Error deleting mark: " . $e->getMessage());

            return back()->with('error', 'Failed to delete mark. Please try again.');
        }
    }

    // Show details of a single mark
    public function show(Mark $mark)
    {
        $mark->load(['student', 'schoolClass']);

        return view('admin.marks.show', compact('mark'));
    }
}
