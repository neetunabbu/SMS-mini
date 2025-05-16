@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Attendance List</h2>

    <a href="{{ route('admin.attendances.create') }}" class="btn btn-success mb-3">Add Attendance</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Class</th>
                <th>Student</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->id }}</td>
                    <!-- Updated to display class name correctly -->
                    <td>{{ $attendance->schoolClass->class_name ?? 'N/A' }}</td>
                    <td>{{ $attendance->student->name ?? 'N/A' }}</td>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->status }}</td>
                    <td>
                        <a href="{{ route('admin.attendances.show', $attendance->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.attendances.edit', $attendance->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('admin.attendances.destroy', $attendance->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this attendance?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
