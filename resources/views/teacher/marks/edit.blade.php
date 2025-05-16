@extends('teacher.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Class: {{ $class->name }}</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teacher.schoolClass.update', $class->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Class Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $class->name) }}" required>
        </div>
        <div class="form-group">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control" value="{{ old('subject', $class->subject) }}" required>
        </div>
        <div class="form-group">
            <label>Section</label>
            <input type="text" name="section" class="form-control" value="{{ old('section', $class->section) }}" required>
        </div>
        <div class="form-group">
            <label>Student Count</label>
            <input type="number" name="student_count" class="form-control" value="{{ old('student_count', $class->student_count) }}">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description', $class->description) }}</textarea>
        </div>
        <div class="form-group">
            <label>Class Code</label>
            <input type="text" name="class_code" class="form-control" value="{{ old('class_code', $class->class_code) }}">
        </div>
        <div class="form-check mt-2">
            <input type="checkbox" name="is_active" class="form-check-input" {{ $class->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>
        <button type="submit" class="btn btn-success mt-3">Update</button>
    </form>
</div>
@endsection
