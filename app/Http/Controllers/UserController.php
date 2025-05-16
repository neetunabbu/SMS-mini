<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show all users (Admin dashboard)
    public function index()
    {
        $users = User::paginate(10); // Paginate 10 users per page
        return view('admin.users.index', compact('users'));
    }

    // Show form to create a new user
    public function create()
    {
        return view('admin.users.create');
    }

    // Store a newly created user
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role'     => 'required|in:admin,teacher,student',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // Show form to edit an existing user
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update an existing user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:admin,teacher,student',
        ]);

        $user->update($request->only('name', 'email', 'role'));

        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully.');
    }

    // Delete a user
    public function destroy(User $user)
    {
        if ($user->id == Auth::id()) {
            return redirect()->route('admin.users.index')->withErrors(['error' => 'You cannot delete your own account.']);
        }

        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }

    // ========== Profile Methods ==========

    /**
     * Show the admin's profile.
     */
    public function showProfile()
    {
        $admin = Auth::user();
        return view('admin.profile.show', compact('admin'));
    }

    /**
     * Show the form to edit admin's profile.
     */
    public function editProfile()
    {
        $admin = Auth::user();
        return view('admin.profile.edit', compact('admin'));
    }

    /**
     * Update the admin's profile.
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $admin->id,
        ]);

        $admin->update($request->only('name', 'email'));

        return redirect()->route('admin.profile.show')->with('success', 'Profile updated successfully!');
    }

    /**
     * Show the form to change admin's password.
     */
    public function editPassword()
    {
        return view('admin.profile.passwordEdit');
    }

    /**
     * Update admin's password.
     */
    public function updatePassword(Request $request)
    {
        $admin = Auth::user();

        // Validate the incoming request
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|confirmed|min:8',
        ]);

        // Check if the current password matches the stored hash
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Check if the new password is the same as the current password
        if (Hash::check($request->new_password, $admin->password)) {
            return back()->withErrors(['new_password' => 'New password cannot be the same as the current password.']);
        }

        // Update the password with the new hashed password
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        // Log the user out and invalidate the session
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('admin.profile.show')->with('success', 'Password updated successfully!');
    }
}