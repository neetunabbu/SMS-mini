@extends('teacher.layouts.app')

@section('content')
<div class="container">
    <h2>Attendances</h2>
    <a href="{{ route('teacher.attendance.create') }}" class="btn btn-primary mb-3">Create Attendance</a>
    <table class="table">
        <thead>
            <tr>
                <th>Student</th>
                <th>Class</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
            <tr>
                <td>{{ $attendance->student->name }}</td>
                <td>{{ $attendance->schoolClass->name }}</td>
                <td>{{ $attendance->date }}</td>
                <td>{{ ucfirst($attendance->status) }}</td>
                <td>
                    <a href="{{ route('teacher.attendance.edit', $attendance->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('teacher.attendance.destroy', $attendance->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this attendance?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
