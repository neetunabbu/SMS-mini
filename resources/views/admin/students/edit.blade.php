@extends('layouts.app')

@section('content')
<h2>Edit Student</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.students.update', $student->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $student->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $student->email) }}" required>
    </div>

    <div class="mb-3">
        <label for="roll_number" class="form-label">Roll Number:</label>
        <input type="text" class="form-control" id="roll_number" name="roll_number" value="{{ old('roll_number', $student->roll_number) }}" required>
    </div>

    <div class="mb-3">
        <label for="class_id" class="form-label">Class:</label>
        <select name="class_id" class="form-select" required>
            <option value="">-- Select Class --</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}" {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}>
                    {{ $class->name }}
                </option>
            @endforeach
        </select>
    </div>
    

    <div class="mb-3">
        <label for="teacher_id" class="form-label">Teacher:</label>
        <select name="teacher_id" class="form-select" required>
            <option value="">-- Select Teacher --</option>
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}" {{ old('teacher_id', $student->teacher_id) == $teacher->id ? 'selected' : '' }}>
                    {{ $teacher->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Student</button>
</form>
@endsection
