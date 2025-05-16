@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Marks</h2>
    <a href="{{ route('admin.marks.create') }}" class="btn btn-primary mb-3">Add Mark</a>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Student</th>
                <th>Class</th>
                <th>Subject</th>
                <th>Marks Obtained</th>
                <th>Max Marks</th>
                <th>Exam Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($marks as $mark)
            <tr>
                <td>{{ $mark->student ? $mark->student->name : 'No student found' }}</td>
                <td>{{ $mark->schoolClass ? $mark->schoolClass->name : 'No class found' }}</td>
                <td>{{ $mark->subject }}</td>
                <td>{{ $mark->marks_obtained }}</td>
                <td>{{ $mark->max_marks }}</td>
                <td>{{ $mark->exam_type }}</td>
                <td>
                    <a href="{{ route('admin.marks.show', $mark->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('admin.marks.edit', $mark->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.marks.destroy', $mark->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Are you sure to delete?');">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        
    </table>
</div>
@endsection
