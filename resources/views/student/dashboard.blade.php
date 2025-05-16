@extends('student.layouts.app')

@section('content')
<div class="container">
    <h1>Welcome, {{ $student->name }}!</h1>

    <!-- Display Student's Attendance -->
    <div class="card">
        <div class="card-header">Your Attendance</div>
        <div class="card-body">
            <ul>
                @foreach($attendances as $attendance)
                    <li>{{ $attendance->date }} - {{ $attendance->status }} ({{ $attendance->schoolClass->name }})</li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Display Student's Marks -->
    <div class="card mt-4">
        <div class="card-header">Your Marks</div>
        <div class="card-body">
            <ul>
                @foreach($marks as $mark)
                    <li>{{ $mark->subject->name }} - {{ $mark->marks_obtained }} marks ({{ $mark->schoolClass->name }})</li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Display Leave Requests -->
    <div class="card mt-4">
        <div class="card-header">Your Leave Requests</div>
        <div class="card-body">
            <ul>
                @foreach($leaves as $leave)
                    <li>{{ $leave->from_date }} to {{ $leave->to_date }} - Status: {{ $leave->status }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
