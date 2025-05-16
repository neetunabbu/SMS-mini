@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Attendance Details</h2>

    <div class="mb-3">
        <strong>ID:</strong> {{ $attendance->id }}
    </div>

    <div class="mb-3">
        <strong>Class:</strong> {{ $attendance->schoolClass->class_name ?? 'N/A' }}
    </div>

    <div class="mb-3">
        <strong>Student:</strong> {{ $attendance->student->name ?? 'N/A' }}
    </div>

    <div class="mb-3">
        <strong>Date:</strong> {{ $attendance->date }}
    </div>

    <div class="mb-3">
        <strong>Status:</strong> {{ $attendance->status }}
    </div>

    <a href="{{ route('admin.attendances.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
