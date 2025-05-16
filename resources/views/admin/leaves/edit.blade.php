@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Leave Request</h2>

    <form action="{{ route('admin.leaves.update', $leave->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select name="student_id" id="student_id" class="form-control" disabled>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $leave->student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <textarea name="reason" id="reason" class="form-control" rows="3" required>{{ old('reason', $leave->reason) }}</textarea>
            @error('reason') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="from_date" class="form-label">From Date</label>
            <input type="date" name="from_date" id="from_date" class="form-control" value="{{ old('from_date', $leave->from_date) }}" required>
            @error('from_date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="to_date" class="form-label">To Date</label>
            <input type="date" name="to_date" id="to_date" class="form-control" value="{{ old('to_date', $leave->to_date) }}" required>
            @error('to_date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Pending" {{ $leave->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ $leave->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Rejected" {{ $leave->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.leaves.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
