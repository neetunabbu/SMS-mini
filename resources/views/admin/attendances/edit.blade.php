@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($attendance) ? 'Edit Attendance' : 'Attendance Details' }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @isset($attendance) <!-- Edit form if attendance is available -->
        <form action="{{ route('admin.attendances.update', $attendance->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="class_id" class="form-label">Class</label>
                <select name="class_id" id="class_id" class="form-control" required>
                    <option value="" disabled>Select Class</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ $attendance->class_id == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="student_id" class="form-label">Student</label>
                <select name="student_id" id="student_id" class="form-control" required>
                    <option value="">Select Student</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ $attendance->student_id == $student->id ? 'selected' : '' }}>
                            {{ $student->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ $attendance->date }}" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Present" {{ $attendance->status == 'Present' ? 'selected' : '' }}>Present</option>
                    <option value="Absent" {{ $attendance->status == 'Absent' ? 'selected' : '' }}>Absent</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Attendance</button>
        </form>
    @else <!-- Attendance details view -->
        <div class="mb-3">
            <strong>ID:</strong> {{ $attendance->id }}
        </div>

        <div class="mb-3">
            <strong>Class:</strong> {{ $attendance->class->name ?? 'N/A' }}
        </div>

        <div class="mb-3">
            <strong>Student:</strong> {{ $attendance->student->name ?? 'N/A' }}
        </div>

        <div class="mb-3">
            <strong>Date:</strong> {{ $attendance->date }}
        </div>

        <div class="mb-3">
            <strong>Status:</strong> {{ $attendance->status }}
        </div>

        <a href="{{ route('admin.attendances.index') }}" class="btn btn-secondary">Back</a>
    @endisset
</div>
@endsection
