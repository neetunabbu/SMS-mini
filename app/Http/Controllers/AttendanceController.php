<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // List all attendance records
    public function index()
    {
        $attendances = Attendance::with(['student', 'schoolClass'])->latest()->get();
        return view('admin.attendances.index', compact('attendances'));
    }

    // Show form to create attendance
    public function create()
    {
        $students = Student::all();
        $classes = SchoolClass::all();
        return view('admin.attendances.create', compact('students', 'classes'));
    }

    // Store new attendance record
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id'   => 'required|exists:school_classes,id',
            'date'       => 'required|date',
            'status'     => 'required|in:Present,Absent',
        ]);

        // Prevent duplicate attendance for same student and date
        if (Attendance::where('student_id', $validated['student_id'])
            ->where('date', $validated['date'])
            ->exists()) {
            return back()->withErrors(['Attendance already marked for this student on this date.'])->withInput();
        }

        Attendance::create($validated);

        return redirect()->route('admin.attendances.index')->with('success', 'Attendance added successfully.');
    }

    // Show form to edit existing attendance
    public function edit(Attendance $attendance)
    {
        $students = Student::all();
        $classes  = SchoolClass::all();
        return view('admin.attendances.edit', compact('attendance', 'students', 'classes'));
    }

    // Update attendance record
    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id'   => 'required|exists:school_classes,id',
            'date'       => 'required|date',
            'status'     => 'required|in:Present,Absent',
        ]);

        $attendance->update($validated);

        return redirect()->route('admin.attendances.index')->with('success', 'Attendance updated successfully.');
    }

    // Delete an attendance record
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('admin.attendances.index')->with('success', 'Attendance deleted successfully.');
    }

    // Show details of a specific attendance
    public function show(Attendance $attendance)
    {
        $attendance->load(['student', 'schoolClass']);
        return view('admin.attendances.show', compact('attendance'));
    }
}
