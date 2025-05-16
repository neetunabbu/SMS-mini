<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Mark;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherDashboardController extends Controller
{
    public function dashboard()
    {
        $teacher = Auth::user();
        $classes = SchoolClass::where('teacher_id', $teacher->id)->get();
        return view('teacher.dashboard', compact('classes'));
    }
    public function index()
    {
        $teacher = Auth::user();
        $classes = SchoolClass::where('teacher_id', $teacher->id)->withCount('students')->get();
        $classIds = $classes->pluck('id')->toArray();
        $attendances = Attendance::whereIn('class_id', $classIds)->with(['student', 'schoolClass'])->latest()->take(5)->get();
        $marks = Mark::whereIn('class_id', $classIds)->with(['student', 'schoolClass'])->latest()->take(5)->get();
        $leaves = Leave::whereIn('student_id', function ($query) use ($classIds) {
            $query->select('id')->from('students')->whereIn('class_id', $classIds);
        })->with(['student.schoolClass'])->latest()->take(5)->get();

        return view('teacher.dashboard', compact('teacher', 'classes', 'attendances', 'marks', 'leaves'));
    }

    // School Class
    public function indexClasses()
    {
        $classes = SchoolClass::where('teacher_id', Auth::id())->get();
        return view('teacher.schoolClass.index', compact('classes'));
    }

    public function createClasses()
    {
        return view('teacher.schoolClass.create');
    }

    public function storeClasses(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'section' => 'required|string|max:50',
            'student_count' => 'nullable|integer|min:0',
            'description' => 'nullable|string|max:500',
            'class_code' => 'nullable|string|max:50',
        ]);

        $validated['teacher_id'] = Auth::id();
        $validated['is_active'] = $request->has('is_active');
        $validated['class_name'] = $validated['name'];
        SchoolClass::create($validated);

        return redirect()->route('teacher.schoolClass.index')->with('success', 'Class created successfully!');
    }

    public function showClasses($id)
    {
        $class = SchoolClass::with('students')->findOrFail($id);
        return view('teacher.schoolClass.show', compact('class'));
    }

    public function editClasses($id)
    {
        $class = SchoolClass::findOrFail($id);
        return view('teacher.schoolClass.edit', compact('class'));
    }

    public function updateClasses(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'section' => 'required|string|max:50',
            'student_count' => 'nullable|integer|min:0',
            'description' => 'nullable|string|max:500',
            'class_code' => 'nullable|string|max:50',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $class = SchoolClass::findOrFail($id);
        if ($class->teacher_id !== Auth::id()) {
            return redirect()->route('teacher.schoolClass.index')->with('error', 'Unauthorized action.');
        }
        $class->update($validated);

        return redirect()->route('teacher.schoolClass.index')->with('success', 'Class updated successfully!');
    }

    public function destroyClasses($id)
    {
        $class = SchoolClass::findOrFail($id);
        $class->delete();
        return redirect()->route('teacher.schoolClass.index')->with('success', 'Class deleted successfully!');
    }

    // Attendance
    public function indexAttendance()
    {
        $teacher = Auth::user();
        $classes = SchoolClass::where('teacher_id', $teacher->id)->get();
        $classIds = $classes->pluck('id')->toArray();
    
        $attendances = Attendance::whereIn('class_id', $classIds)
                        ->with(['student', 'schoolClass'])
                        ->latest()
                        ->get();
    
        return view('teacher.attendance.index', compact('attendances', 'classes'));
    }
    

    public function createAttendance()
    {
        $class = SchoolClass::where('teacher_id', Auth::id())->with('students')->first();
        if (!$class) {
            return redirect()->route('teacher.dashboard')->with('error', 'No class assigned.');
        }

        $students = $class->students;

        return view('teacher.attendance.create', compact('class', 'students'));
    }

    public function storeAttendance(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent',
        ]);

        $class = SchoolClass::where('teacher_id', Auth::id())->first();
        if (!$class) {
            return redirect()->route('teacher.dashboard')->with('error', 'No class assigned.');
        }

        Attendance::create([
            'student_id' => $validated['student_id'],
            'class_id' => $class->id,
            'date' => $validated['date'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('teacher.attendance.index')->with('success', 'Attendance recorded.');
    }

    public function editAttendance($id)
    {
        $attendance = Attendance::findOrFail($id);
        $students = Student::where('class_id', $attendance->class_id)->get();
        return view('teacher.attendance.edit', compact('attendance', 'students'));
    }

    public function updateAttendance(Request $request, $id)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent',
        ]);

        $attendance = Attendance::findOrFail($id);
        $attendance->update($validated);

        return redirect()->route('teacher.attendance.index')->with('success', 'Attendance updated.');
    }

    public function destroyAttendance($id)
    {
        Attendance::destroy($id);
        return redirect()->route('teacher.attendance.index')->with('success', 'Attendance deleted.');
    }

    // Marks
    public function indexMarks()
{
    $teacher = Auth::user();
    $classes = SchoolClass::where('teacher_id', $teacher->id)->get();
    $classIds = $classes->pluck('id')->toArray();

    $marks = Mark::whereIn('class_id', $classIds)
        ->with(['student', 'schoolClass'])
        ->latest()
        ->get();

    // dd($marks); // Check what data is being returned

    return view('teacher.marks.index', compact('marks', 'classes'));
}


    public function createMarks()
    {
        $class = SchoolClass::where('teacher_id', Auth::id())->with('students')->first();
        if (!$class) {
            return redirect()->route('teacher.dashboard')->with('error', 'No class assigned.');
        }

        $students = $class->students;

        return view('teacher.marks.create', compact('class', 'students'));
    }

    public function storeMarks(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:school_classes,id',
            'subject' => 'required|string',
            'marks_obtained' => 'required|numeric',
            'max_marks' => 'required|numeric',
            'exam_type' => 'required|string',

        ]);

        $class = SchoolClass::where('teacher_id', Auth::id())->first();
        if (!$class) {
            return redirect()->route('teacher.dashboard')->with('error', 'No class assigned.');
        }

        Mark::create([
            'student_id' => $validated['student_id'],
            'class_id' => $validated['class_id'],
            'subject' => $validated['subject'],
            'marks_obtained' => $validated['marks_obtained'],
            'max_marks' => $validated['max_marks'],
            'exam_type' => $validated['exam_type'],
        ]);
        

        return redirect()->route('teacher.marks.index')->with('success', 'Marks added successfully.');
    }

    public function editMarks($id)
    {
        $mark = Mark::findOrFail($id);
        return view('teacher.marks.edit', compact('mark'));
    }

    public function updateMarks(Request $request, $id)
    {
        $validated = $request->validate([
            'subject' => 'required|string',
            'marks_obtained' => 'required|numeric',
            'max_marks' => 'required|numeric',
            'exam_type' => 'required|string',
        ]);

        $mark = Mark::findOrFail($id);
        $mark->update($validated);

        return redirect()->route('teacher.marks.index')->with('success', 'Marks updated successfully.');
    }

    public function destroyMarks($id)
    {
        Mark::destroy($id);
        return redirect()->route('teacher.marks.index')->with('success', 'Marks deleted successfully.');
    }

    // Leave Approval
    public function indexLeaveApproval()
    {
        $class = SchoolClass::where('teacher_id', Auth::id())->first();
        if (!$class) {
            return redirect()->route('teacher.dashboard')->with('error', 'No class assigned.');
        }
        $leaveRequests = Leave::whereHas('student', function ($query) use ($class) {
            $query->where('class_id', $class->id);
        })->with('student')->get();

        return view('teacher.leaveApproval.index', compact('leaveRequests'));
    }

    public function updateLeaveStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $leave = Leave::findOrFail($id);
        $leave->update(['status' => $validated['status']]);

        return redirect()->route('teacher.leaveApproval.index')->with('success', 'Leave status updated.');
    }

    // Profile
    public function showProfile()
    {
        $teacher = auth()->user();
        return view('teacher.profile.show', compact('teacher'));
    }

    public function editProfile()
    {
        $teacher = auth()->user();
        return view('teacher.profile.edit', compact('teacher'));
    }

    public function updateProfile(Request $request)
    {
        $teacher = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacher->id,
        ]);

        $teacher->update($request->only('name', 'email'));
        return redirect()->route('teacher.profile.show')->with('success', 'Profile updated successfully.');
    }

    public function editPassword()
    {
        return view('teacher.profile.password_edit');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $teacher = auth()->user();
        if (!Hash::check($request->current_password, $teacher->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $teacher->password = Hash::make($request->new_password);
        $teacher->save();
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('teacher.profile.show')->with('success', 'Password updated successfully.');
    }
}
