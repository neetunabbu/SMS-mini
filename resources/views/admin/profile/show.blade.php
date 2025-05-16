@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Profile</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $admin->name }}</p>
            <p><strong>Email:</strong> {{ $admin->email }}</p>
            <p><strong>Role:</strong> {{ $admin->role }}</p>
            <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
            <a href="{{ route('admin.password.edit') }}" class="btn btn-warning">Change Password</a>
        </div>
    </div>
</div>
@endsection
