@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Leave Request Details</h2>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $leave->id }}</td>
        </tr>
        <tr>
            <th>Student Name</th>
            <td>{{ $leave->student->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Reason</th>
            <td>{{ $leave->reason }}</td>
        </tr>
        <tr>
            <th>From Date</th>
            <td>{{ $leave->from_date }}</td>
        </tr>
        <tr>
            <th>To Date</th>
            <td>{{ $leave->to_date }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $leave->status }}</td>
        </tr>
    </table>

    <a href="{{ route('admin.leaves.index') }}" class="btn btn-secondary">Back to Leave Requests</a>
</div>
@endsection
