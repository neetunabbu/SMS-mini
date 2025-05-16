<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login request
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return $this->authenticated($request, Auth::user());
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Redirect user after authentication based on role
    protected function authenticated(Request $request, $user)
    {
        $role = $user->role;

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
            case 'teacher':
                return redirect()->route('teacher.dashboard')->with('success', 'Welcome Teacher!');
            case 'student':
                return redirect()->route('student.dashboard')->with('success', 'Welcome Student!');
            default:
                return redirect()->route('login')->withErrors('Unauthorized action.');
        }
    }

    // ✅ Add this logout method!
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
