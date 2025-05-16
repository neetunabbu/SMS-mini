@extends('student.layouts.app')

@section('content')
<div class="container">
    <h1>Your Attendance</h1>
    <div class="card">
        <div class="card-header">Attendance Records</div>
        <div class="card-body">
            <ul>
                @foreach($attendances as $attendance)
                    <li>{{ $attendance->date }} - {{ $attendance->status }} ({{ $attendance->schoolClass->name }})</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
