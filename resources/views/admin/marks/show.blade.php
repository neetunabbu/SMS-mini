@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mark Details</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Student:</strong> {{ $mark->student->name }}</p>
            <p><strong>Class:</strong> {{ $mark->schoolClass->name }}</p>
            <p><strong>Subject:</strong> {{ $mark->subject }}</p>
            <p><strong>Marks Obtained:</strong> {{ $mark->marks_obtained }}</p>
            <p><strong>Max Marks:</strong> {{ $mark->max_marks }}</p>
            <p><strong>Exam Type:</strong> {{ $mark->exam_type }}</p>
            <a href="{{ route('admin.marks.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
