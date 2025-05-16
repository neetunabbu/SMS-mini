@extends('layouts.app')

@section('content')
<h2>Student Details</h2>

<div class="mb-3">
    <p><strong>Name:</strong> {{ $student->name }}</p>
    <p><strong>Email:</strong> {{ $student->email }}</p>
    <p><strong>Roll Number:</strong> {{ $student->roll_number }}</p>
    <p><strong>Class:</strong> {{ $student->schoolClass ? $student->schoolClass->name : '-' }}</p>
    <p><strong>Teacher:</strong> {{ $student->teacher ? $student->teacher->name : '-' }}</p>
    <p><strong>Created At:</strong> {{ $student->created_at->format('d-m-Y H:i A') }}</p>
</div>

<a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
