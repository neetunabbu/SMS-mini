@extends('teacher.layouts.app')

@section('content')
<div class="container">
    <h2>Add Marks for Students</h2>

    <form action="{{ route('teacher.marks.store') }}" method="POST">
        @csrf

        <!-- Student Dropdown -->
        <div class="form-group">
            <label for="student_id">Student</label>
            <select name="student_id" class="form-control" required>
                <option value="">Select Student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Class Dropdown -->
        <div class="form-group mt-3">
            <label for="class_id">Class</label>
            <select name="class_id" class="form-control" required>
                <option value="">Select Class</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Subject Input -->
        <div class="form-group mt-3">
            <label for="subject">Subject</label>
            <input type="text" name="subject" class="form-control" required>
        </div>

        <!-- Marks Obtained Input -->
        <div class="form-group mt-3">
            <label for="marks_obtained">Marks Obtained</label>
            <input type="number" name="marks_obtained" class="form-control" required>
        </div>

        <!-- Max Marks Input -->
        <div class="form-group mt-3">
            <label for="max_marks">Max Marks</label>
            <input type="number" name="max_marks" class="form-control" required>
        </div>

        <!-- Exam Type Input -->
        <div class="form-group mt-3">
            <label for="exam_type">Exam Type</label>
            <input type="text" name="exam_type" class="form-control" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-4">Add Marks</button>
    </form>
</div>
@endsection
