@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Mark</h2>
    <form action="{{ route('admin.marks.update', $mark->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Student</label>
            <select name="student_id" class="form-control">
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $student->id == $mark->student_id ? 'selected' : '' }}>{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Class</label>
            <select name="class_id" class="form-control">
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ $class->id == $mark->class_id ? 'selected' : '' }}>{{ $class->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control" value="{{ $mark->subject }}">
        </div>

        <div class="mb-3">
            <label>Marks Obtained</label>
            <input type="number" name="marks_obtained" class="form-control" value="{{ $mark->marks_obtained }}">
        </div>

        <div class="mb-3">
            <label>Max Marks</label>
            <input type="number" name="max_marks" class="form-control" value="{{ $mark->max_marks }}">
        </div>

        <div class="mb-3">
            <label>Exam Type</label>
            <input type="text" name="exam_type" class="form-control" value="{{ $mark->exam_type }}">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.marks.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
