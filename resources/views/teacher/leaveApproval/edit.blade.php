@extends('teacher.layouts.app')

@section('content')
    <h2>Approve/Reject Leave Request from {{ $leave->student->name }}</h2>

    <form action="{{ route('teacher.leaveapproval.update', $leave->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="status">Leave Status</label>
            <select name="status" class="form-control" required>
                <option value="approved" {{ $leave->status == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $leave->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update Status</button>
    </form>
@endsection
