@extends('student.layouts.app')

@section('content')
<div class="container">
    <h2>My Profile</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $student->name }}</p>
            <p><strong>Email:</strong> {{ $student->email }}</p>
            <p><strong>Role:</strong> {{ $student->role }}</p>
            <a href="{{ route('student.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
</div>
@endsection
