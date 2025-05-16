@extends('student.layouts.app') <!-- If you have a base layout for students -->

@section('content')
    <h2>Your Leave Requests</h2>
    
    <!-- Success message after submitting leave -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Reason</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaves as $leave)
                <tr>
                    <td>{{ $leave->reason }}</td>
                    <td>{{ $leave->from_date }}</td>
                    <td>{{ $leave->to_date }}</td>
                    <td>{{ ucfirst($leave->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Button to open the form to submit a new leave -->
    <a href="{{ route('student.leaveForm') }}">Request New Leave</a>
@endsection
