@extends('teacher.layouts.app')

@section('content')
<div class="container">
    <h2>My Profile</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $teacher->name }}</p>
            <p><strong>Email:</strong> {{ $teacher->email }}</p>
            <p><strong>Role:</strong> {{ $teacher->role }}</p>
            <a href="{{ route('teacher.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
            <a href="{{ route('teacher.profile.password') }}" class="btn btn-warning">Change Password</a>
        </div>
    </div>
</div>
@endsection
