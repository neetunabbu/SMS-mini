<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Mark;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentDashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $student = $user->student;

        if (!$student) {
            return redirect()->route('home')->with('error', 'Student profile not found.');
        }

        $attendances = $student->attendances;
        $marks = $student->marks;
        $leaves = $student->leaves;

        return view('student.dashboard', compact('student', 'attendances', 'marks', 'leaves'));
    }

    public function attendance()
    {
        $student = Auth::user()->student;

        if (!$student) {
            return redirect()->route('home')->with('error', 'Student profile not found.');
        }

        $attendances = $student->attendances()->orderBy('date', 'desc')->get();

        return view('student.attendance', compact('attendances'));
    }

    public function marks()
    {
        $student = Auth::user()->student;

        if (!$student) {
            return redirect()->route('home')->with('error', 'Student profile not found.');
        }

        $marks = $student->marks()->latest()->get();

        return view('student.marks', compact('marks'));
    }

    public function leaveRequest()
    {
        $student = Auth::user()->student;

        if (!$student) {
            return redirect()->route('home')->with('error', 'Student profile not found.');
        }

        $leaves = $student->leaves()->latest()->get();

        return view('student.leaveApproval', compact('leaves'));
    }

    public function submitLeave(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
        ]);

        $student = Auth::user()->student;

        if (!$student) {
            return redirect()->route('home')->with('error', 'Student profile not found.');
        }

        $student->leaves()->create([
            'reason' => $request->reason,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'status' => 'pending',
        ]);

        return redirect()->route('student.leaveApproval')->with('success', 'Leave request submitted successfully.');
    }

    public function leaveForm()
    {
        return view('student.leaveForm');
    }

    public function profile()
    {
        $student = Auth::user()->student;

        if (!$student) {
            return redirect()->route('home')->with('error', 'Student profile not found.');
        }

        return view('student.profile.show', compact('student'));
    }

    public function editProfile()
    {
        $student = Auth::user()->student;

        if (!$student) {
            return redirect()->route('home')->with('error', 'Student profile not found.');
        }

        return view('student.profile.edit', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        $student = Auth::user()->student;

        if (!$student) {
            return redirect()->route('home')->with('error', 'Student profile not found.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'roll_number' => 'nullable|string|max:50',
        ]);

        $student->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'roll_number' => $request->roll_number,
        ]);

        return redirect()->route('student.profile')->with('success', 'Profile updated successfully.');
    }

    public function editPassword()
    {
        return view('student.profile.password_edit');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Password updated successfully. Please log in again.');
    }
}
