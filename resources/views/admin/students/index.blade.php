@extends('layouts.app')

@section('content')
<h2>Students List</h2>

@if(session('success'))
    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
@endif

<a href="{{ route('admin.students.create') }}" class="btn btn-primary mb-3">Create New Student</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roll Number</th>
            <th>Class</th>
            <th>Teacher</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @forelse($students as $key => $student)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->roll_number }}</td>
            <td>{{ $student->schoolClass ? $student->schoolClass->name : '-' }}</td>
            <td>{{ $student->teacher ? $student->teacher->name : '-' }}</td>
            <td>
                <a href="{{ route('admin.students.show', $student->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">No students found.</td>
        </tr>
    @endforelse
    </tbody>
</table>
@endsection
