@extends('layouts.app')

@section('content')
<h2>Create Student</h2>

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

<form action="{{ route('admin.students.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3">
        <label for="roll_number" class="form-label">Roll Number:</label>
        <input type="text" class="form-control" id="roll_number" name="roll_number" value="{{ old('roll_number') }}" required>
    </div>

    <div class="mb-3">
        <label for="class_id" class="form-label">Class:</label>
        <select name="class_id" id="class_id" class="form-select" required>
            <option value="">-- Select Class --</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                    {{ $class->name }}
                </option>
            @endforeach
        </select>
        @error('class_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="teacher_id" class="form-label">Teacher:</label>
        <select name="teacher_id" id="teacher_id" class="form-select" required>
            <option value="">-- Select Teacher --</option>
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                    {{ $teacher->name }}
                </option>
            @endforeach
        </select>
        @error('teacher_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    

    <button type="submit" class="btn btn-primary">Create Student</button>
</form>
@endsection
