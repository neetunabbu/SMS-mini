@extends('teacher.layouts.app')

@section('content')
    <h2>Mark Attendance</h2>

    <form action="{{ route('teacher.attendance.store') }}" method="POST">
        @csrf
    
        <div class="form-group">
            <label for="student_id">Student</label>
            <select name="student_id" required>
                <option value="">Select Student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
            
        </div>
    
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>
    
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="present">Present</option>
                <option value="absent">Absent</option>
            </select>
        </div>
    
        <button type="submit" class="btn btn-primary mt-3">Mark Attendance</button>
    </form>
    
@endsection
