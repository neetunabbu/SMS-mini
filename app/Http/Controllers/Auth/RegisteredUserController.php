<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;  // Make sure to import the Student model
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration form.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle the incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate incoming registration request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'string', 'in:admin,teacher,student'], // Validate role
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create a new user in the database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role, // Save role
            'password' => Hash::make($request->password),
        ]);

        // If the user is a student, create the related student record
        if ($user->role === 'student') {
            Student::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roll_number' => 'R' . str_pad($user->id, 3, '0', STR_PAD_LEFT), // Auto-generated roll number
                'phone' => '0000000000',  // Default placeholder phone number
            ]);
        }

        // Trigger the Registered event
        event(new Registered($user));

        // Log the user in after registration
        Auth::login($user);

        // Role-based redirection after registration
        return $this->redirectToDashboard($user);
    }

    /**
     * Redirect user to role-based dashboard.
     */
    private function redirectToDashboard(User $user): RedirectResponse
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'teacher') {
            return redirect()->route('teacher.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    }
}
