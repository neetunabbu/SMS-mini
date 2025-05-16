@extends('teacher.layouts.app')

@section('content')
    <h2>Attendance Record for {{ $attendance->student->name }} on {{ $attendance->date }}</h2>

    <table class="table">
        <tr>
            <th>Date</th>
            <td>{{ $attendance->date }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($attendance->status) }}</td>
        </tr>
    </table>

    <a href="{{ route('teacher.attendance.index') }}" class="btn btn-secondary">Back to Attendance Records</a>
@endsection
