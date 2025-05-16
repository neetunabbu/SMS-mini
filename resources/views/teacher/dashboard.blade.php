@extends('teacher.layouts.app')

@section('content')
<div class="container">
    <h1>Welcome, {{ $teacher->name }}!</h1>

    <!-- Display Teacher's Classes -->
    <div class="card">
        <div class="card-header">Your Classes</div>
        <div class="card-body">
            @if($classes->count())
                <ul>
                    @foreach($classes as $class)
                        <li>{{ $class->name }} ({{ $class->students_count }} students)</li>
                    @endforeach
                </ul>
            @else
                <p>No classes assigned yet.</p>
            @endif
        </div>
    </div>

    <!-- Display Recent Attendance -->
    <div class="card mt-4">
        <div class="card-header">Recent Attendance</div>
        <div class="card-body">
            @if($attendances->count())
                <ul>
                    @foreach($attendances as $attendance)
                        <li>{{ $attendance->student->name }} - {{ ucfirst($attendance->status) }} ({{ $attendance->schoolClass->name }})</li>
                    @endforeach
                </ul>
            @else
                <p>No recent attendance records.</p>
            @endif
        </div>
    </div>

    <!-- Display Recent Marks -->
    <div class="card mt-4">
        <div class="card-header">Recent Marks</div>
        <div class="card-body">
            @if($marks->count())
                <ul>
                    @foreach($marks as $mark)
                        <li>{{ $mark->student->name }} - {{ $mark->marks_obtained }} / {{ $mark->max_marks }} ({{ $mark->subject }}, {{ $mark->schoolClass->name }})</li>
                    @endforeach
                </ul>
            @else
                <p>No recent marks records.</p>
            @endif
        </div>
    </div>

    <!-- Display Recent Leave Requests -->
    <div class="card mt-4">
        <div class="card-header">Recent Leave Requests</div>
        <div class="card-body">
            @if($leaves->count())
                <ul>
                    @foreach($leaves as $leave)
                        <li>{{ $leave->student->name }} - {{ ucfirst($leave->status) }} ({{ $leave->student->schoolClass->name }})</li>
                    @endforeach
                </ul>
            @else
                <p>No recent leave requests.</p>
            @endif
        </div>
    </div>

</div>
@endsection
