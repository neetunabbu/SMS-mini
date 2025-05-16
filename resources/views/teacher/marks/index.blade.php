@extends('teacher.layouts.app')

@section('content')
<div class="container">
    <h2>Marks List</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Class</th>
                <th>Subject</th>
                <th>Marks Obtained</th>
                <th>Max Marks</th>
                <th>Exam Type</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($marks as $mark)
                <tr>
                    <td>{{ $mark->student->name }}</td>
                    <td>{{ $mark->schoolClass->class_name }}</td>
                    <td>{{ $mark->subject }}</td>
                    <td>{{ $mark->marks_obtained }}</td>
                    <td>{{ $mark->max_marks }}</td>
                    <td>{{ $mark->exam_type }}</td>
                    <td>{{ $mark->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No marks available.</td>
                    
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
