@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Mark</h2>
    <form action="{{ route('admin.marks.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Student</label>
            <select name="student_id" class="form-control">
                <option value="">Select Student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
            @error('student_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Class</label>
            <select name="class_id" class="form-control">
                <option value="">Select Class</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
            @error('class_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control" value="{{ old('subject') }}">
            @error('subject') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Marks Obtained</label>
            <input type="number" name="marks_obtained" class="form-control" value="{{ old('marks_obtained') }}">
            @error('marks_obtained') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Max Marks</label>
            <input type="number" name="max_marks" class="form-control" value="{{ old('max_marks') }}">
            @error('max_marks') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Exam Type</label>
            <input type="text" name="exam_type" class="form-control" value="{{ old('exam_type') }}">
            @error('exam_type') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-success">Submit</button>
        <a href="{{ route('admin.marks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
