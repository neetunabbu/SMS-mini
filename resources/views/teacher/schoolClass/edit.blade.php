@extends('teacher.layouts.app')

@section('content')
    <h2>Edit Class</h2>

    <form action="{{ route('teacher.schoolClass.update', $class->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Class Name</label>
            <input type="text" name="name" class="form-control" value="{{ $class->name }}" required>
        </div>

        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" name="subject" class="form-control" value="{{ $class->subject }}" required>
        </div>

        <div class="form-group">
            <label for="section">Section</label>
            <input type="text" name="section" class="form-control" value="{{ $class->section }}" required>
        </div>

        <div class="form-group">
            <label for="student_count">Student Count</label>
            <input type="number" name="student_count" class="form-control" value="{{ $class->student_count }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $class->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="class_code">Class Code</label>
            <input type="text" name="class_code" class="form-control" value="{{ $class->class_code }}">
        </div>

        <div class="form-group form-check mt-2">
            <input type="checkbox" name="is_active" class="form-check-input" id="is_active"
                {{ $class->is_active ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Is Active</label>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Class</button>
    </form>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
