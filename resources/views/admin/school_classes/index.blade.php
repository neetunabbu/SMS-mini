@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>School Classes</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.school_classes.create') }}" class="btn btn-primary mb-3">Create New Class</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Class Name</th>
                    <th>Subject</th>
                    <th>Teacher</th>
                    <th>Student Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $class)
                    <tr>
                        <td>{{ $class->class_name }}</td>
                        <td>{{ $class->subject }}</td>
                        <td>{{ optional($class->teacher)->name ?? 'Not Assigned' }}</td>
                        <td>{{ $class->student_count }}</td>
                        <td>
                            <a href="{{ route('admin.school_classes.edit', $class) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.school_classes.destroy', $class) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
