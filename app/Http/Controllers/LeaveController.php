<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Student;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    // List all leave requests
    public function index()
    {
        $leaves = Leave::with('student')->latest()->get();
        return view('admin.leaves.index', compact('leaves'));
    }

    // Show form to create a leave request
    public function create()
    {
        $students = Student::all();
        return view('admin.leaves.create', compact('students'));
    }

    // Store a new leave request
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'reason'     => 'required|string|max:500',
            'from_date'  => 'required|date',
            'to_date'    => 'required|date|after_or_equal:from_date',
            'status'     => 'required|in:Pending,Approved,Rejected',
        ]);

        Leave::create($validated);

        return redirect()->route('admin.leaves.index')->with('success', 'Leave request submitted successfully.');
    }

    // Show form to edit a leave request
    public function edit(Leave $leave)
    {
        $students = Student::all();
        return view('admin.leaves.edit', compact('leave', 'students'));
    }

    // Update an existing leave request
    public function update(Request $request, Leave $leave)
    {
        $validated = $request->validate([
            'reason'    => 'required|string|max:500',
            'from_date' => 'required|date',
            'to_date'   => 'required|date|after_or_equal:from_date',
            'status'    => 'required|in:Pending,Approved,Rejected',
        ]);

        $leave->update($validated);

        return redirect()->route('admin.leaves.index')->with('success', 'Leave updated successfully.');
    }

    // Delete a leave request
    public function destroy(Leave $leave)
    {
        $leave->delete();

        return redirect()->route('admin.leaves.index')->with('success', 'Leave deleted successfully.');
    }

    // Show a single leave request
    public function show(Leave $leave)
    {
        $leave->load('student');
        return view('admin.leaves.show', compact('leave'));
    }
}
