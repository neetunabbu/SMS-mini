@extends('layouts.app') {{-- Assuming you have an admin layout --}}

@section('content')
<div class="container mt-4">
    <h2>Leave Requests</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- <a href="{{ route('admin.leaves.create') }}" class="btn btn-primary mb-3">Create New Leave</a> --}}

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Reason</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaves as $leave)
                <tr>
                    <td>{{ $leave->id }}</td>
                    <td>{{ $leave->student->name ?? 'N/A' }}</td>
                    <td>{{ $leave->reason }}</td>
                    <td>{{ $leave->from_date }}</td>
                    <td>{{ $leave->to_date }}</td>
                    <td>{{ $leave->status }}</td>
                    <td>
                        <a href="{{ route('admin.leaves.edit', $leave->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.leaves.destroy', $leave->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            @if($leaves->isEmpty())
                <tr><td colspan="7" class="text-center">No leaves found.</td></tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
