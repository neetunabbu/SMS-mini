@extends('teacher.layouts.app')

@section('content')
    <h2>Edit Attendance for {{ $attendance->student->name }}</h2>

    <form action="{{ route('teacher.attendance.update', $attendance->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" value="{{ $attendance->date }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="present" {{ $attendance->status == 'present' ? 'selected' : '' }}>Present</option>
                <option value="absent" {{ $attendance->status == 'absent' ? 'selected' : '' }}>Absent</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update Attendance</button>
    </form>
@endsection
