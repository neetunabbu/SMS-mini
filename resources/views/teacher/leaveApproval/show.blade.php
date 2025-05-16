@extends('teacher.layouts.app')

@section('content')
    <h2>Leave Request for {{ $leave->student->name }}</h2>

    <table class="table">
        <tr>
            <th>From Date</th>
            <td>{{ $leave->from_date }}</td>
        </tr>
        <tr>
            <th>To Date</th>
            <td>{{ $leave->to_date }}</td>
        </tr>
        <tr>
            <th>Reason</th>
            <td>{{ $leave->reason }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($leave->status) }}</td>
        </tr>
    </table>

    <a href="{{ route('teacher.leaveapproval.index') }}" class="btn btn-secondary">Back to Leave Requests</a>
@endsection
