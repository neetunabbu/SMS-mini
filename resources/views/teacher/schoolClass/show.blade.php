@extends('teacher.layouts.app')

@section('content')
    <h2>Class Details</h2>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $class->name }}</h4>
            <p><strong>Subject:</strong> {{ $class->subject }}</p>
            <p><strong>Section:</strong> {{ $class->section }}</p>
            <p><strong>Student Count:</strong> {{ $class->student_count }}</p>
            <p><strong>Class Code:</strong> {{ $class->class_code }}</p>
            <p><strong>Description:</strong> {{ $class->description }}</p>
            <p><strong>Status:</strong> {{ $class->is_active ? 'Active' : 'Inactive' }}</p>
        </div>
    </div>

    <a href="{{ route('teacher.schoolClass.index') }}" class="btn btn-secondary mt-3">Back to Classes</a>
@endsection
