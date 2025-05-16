@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Class: {{ $school_class->class_name }}</h1>

        <form action="{{ route('admin.school_classes.update', $school_class) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="class_name">Class Name</label>
                <input type="text" id="class_name" name="class_name" class="form-control" value="{{ old('class_name', $school_class->class_name) }}" required>
                @error('class_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" class="form-control" value="{{ old('subject', $school_class->subject) }}" required>
                @error('subject')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="teacher_id">Select Teacher</label>
                <select id="teacher_id" name="teacher_id" class="form-control" required>
                    <option value="">-- Select Teacher --</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ old('teacher_id', $school_class->teacher_id) == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                    @endforeach
                </select>
                @error('teacher_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="student_count">Student Count</label>
                <input type="number" id="student_count" name="student_count" class="form-control" value="{{ old('student_count', $school_class->student_count) }}" min="0">
                @error('student_count')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-warning">Update Class</button>
        </form>
    </div>
@endsection
