@extends('teacher.layouts.app')

@section('content')
    <h2>Leave Requests</h2>
    
    @if ($leaveRequests->isEmpty())
        <p>No leave requests available.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Leave Dates</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaveRequests as $leave)
                    <tr>
                        <td>{{ $leave->student->name }}</td>
                        <td>{{ $leave->from_date }} to {{ $leave->to_date }}</td>
                        <td>{{ ucfirst($leave->status) }}</td>
                        <td>
                            <a href="{{ route('teacher.leaveapproval.edit', $leave->id) }}" class="btn btn-warning btn-sm">Approve/Reject</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
