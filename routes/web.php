<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\SchoolClassController;

// ========================= ROOT REDIRECT =========================
Route::redirect('/', '/login');

// ========================= DASHBOARD REDIRECT BASED ON ROLE =========================
Route::get('/dashboard-redirect', function () {
    $role = Auth::user()->role ?? null;

    return match ($role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'teacher' => redirect()->route('teacher.dashboard'),
        'student' => redirect()->route('student.dashboard'),
        default   => abort(403, 'Unauthorized action.'),
    };
})->middleware('auth')->name('dashboard.redirect');

// ========================= AUTHENTICATION ROUTES =========================
// Login & Logout
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Logout (logged-in users)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store'])->name('register.store');

// ========================= ADMIN ROUTES =========================
Route::prefix('admin')->middleware(['auth', 'is_admin'])->name('admin.')->group(function () {
    // Dashboard
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

    // Resource Controllers
    Route::resource('users', UserController::class);
    Route::post('users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulkDelete');
    Route::resource('students', StudentController::class);
    Route::post('students/bulk-delete', [StudentController::class, 'bulkDelete'])->name('students.bulkDelete');
    Route::resource('teachers', TeacherController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('marks', MarkController::class);
    Route::resource('leaves', LeaveController::class);
    Route::resource('school_classes', SchoolClassController::class);

    // Profile Management
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

    // Password Management
    Route::get('/password/edit', [UserController::class, 'editPassword'])->name('password.edit');
    Route::put('/password/update', [UserController::class, 'updatePassword'])->name('password.update');
});

// ========================= TEACHER ROUTES =========================
Route::prefix('teacher')->middleware(['auth', 'is_teacher'])->name('teacher.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');

    // Attendance Management
    Route::prefix('attendance')->name('attendance.')->group(function () {
        Route::get('/', [TeacherDashboardController::class, 'indexAttendance'])->name('index');
        Route::get('/create', [TeacherDashboardController::class, 'createAttendance'])->name('create');
        Route::post('/', [TeacherDashboardController::class, 'storeAttendance'])->name('store');
        Route::get('/{id}/edit', [TeacherDashboardController::class, 'editAttendance'])->name('edit');
        Route::put('/{id}', [TeacherDashboardController::class, 'updateAttendance'])->name('update');
        Route::delete('/{id}', [TeacherDashboardController::class, 'destroyAttendance'])->name('destroy');
    });

    // Marks Management
    Route::prefix('marks')->name('marks.')->group(function () {
        Route::get('/', [TeacherDashboardController::class, 'indexMarks'])->name('index');
        Route::get('/create', [TeacherDashboardController::class, 'createMarks'])->name('create');
        Route::post('/', [TeacherDashboardController::class, 'storeMarks'])->name('store');
        Route::get('/{id}/edit', [TeacherDashboardController::class, 'editMarks'])->name('edit');
        Route::put('/{id}', [TeacherDashboardController::class, 'updateMarks'])->name('update');
        Route::delete('/{id}', [TeacherDashboardController::class, 'destroyMarks'])->name('ustry');
    });

    // School Classes Management
    Route::prefix('schoolClass')->name('schoolClass.')->group(function () {
        Route::get('/', [TeacherDashboardController::class, 'indexClasses'])->name('index');
        Route::get('/create', [TeacherDashboardController::class, 'createClasses'])->name('create');
        Route::post('/', [TeacherDashboardController::class, 'storeClasses'])->name('store');
        Route::get('/{id}', [TeacherDashboardController::class, 'showClasses'])->name('show');
        Route::get('/{id}/edit', [TeacherDashboardController::class, 'editClasses'])->name('edit');
        Route::put('/{id}', [TeacherDashboardController::class, 'updateClasses'])->name('update');
        Route::delete('/{id}', [TeacherDashboardController::class, 'destroyClasses'])->name('destroy');
    });

    // Leave Approval
    Route::prefix('leaveApproval')->name('leaveApproval.')->group(function () {
        Route::get('/', [TeacherDashboardController::class, 'indexLeaveApproval'])->name('index');
        Route::get('/{id}/edit', [TeacherDashboardController::class, 'editLeaveApproval'])->name('edit');
        Route::put('/{id}', [TeacherDashboardController::class, 'updateLeaveApproval'])->name('update');
    });

    // Profile Management
    Route::get('/profile', [TeacherDashboardController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [TeacherDashboardController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [TeacherDashboardController::class, 'updateProfile'])->name('profile.update');

    // Password Management
    Route::get('/profile/password', [TeacherDashboardController::class, 'editPassword'])->name('profile.password');
    Route::put('/profile/password', [TeacherDashboardController::class, 'updatePassword'])->name('profile.password.update');
});

// ========================= STUDENT ROUTES =========================
Route::prefix('student')->middleware(['auth', 'is_student'])->name('student.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');

    // Attendance View
    Route::get('/attendance', [StudentDashboardController::class, 'attendance'])->name('attendance');

    // Marks View
    Route::get('/marks', [StudentDashboardController::class, 'marks'])->name('marks');

    // Leave Requests
    Route::get('/leave-approval', [StudentDashboardController::class, 'leaveRequest'])->name('leaveApproval');
    Route::get('/leave-form', [StudentDashboardController::class, 'showLeaveForm'])->name('leaveForm');
    Route::get('/leaveForm', [StudentDashboardController::class, 'leaveForm'])->name('leaveForm');

    // Profile View & Edit
    Route::get('/profile', [StudentDashboardController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [StudentDashboardController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [StudentDashboardController::class, 'updateProfile'])->name('profile.update');

    // Password Change
    Route::get('/profile/password', [StudentDashboardController::class, 'editPassword'])->name('profile.password');
    Route::post('/profile/password/update', [StudentDashboardController::class, 'updatePassword'])->name('profile.password.update');
});