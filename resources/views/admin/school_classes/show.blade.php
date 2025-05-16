@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Class Details: {{ $school_class->class_name }}</h1>

        <table class="table">
            <tr>
                <th>Class Name</th>
                <td>{{ $school_class->class_name }}</td>
            </tr>
            <tr>
                <th>Subject</th>
                <td>{{ $school_class->subject }}</td>
            </tr>
            <tr>
                <th>Teacher</th>
                <td>{{ optional($school_class->teacher)->name ?? 'Not Assigned' }}</td>
            </tr>
            <tr>
                <th>Student Count</th>
                <td>{{ $school_class->student_count }}</td>
            </tr>
        </table>

        <a href="{{ route('admin.school_classes.index') }}" class="btn btn-secondary">Back to Class List</a>
    </div>
@endsection
