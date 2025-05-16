@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Teacher Details</h1>

    <div class="card">
        <div class="card-header">
            <strong>{{ $teacher->name }}</strong>
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ $teacher->email }}</p>
            <p><strong>Phone Number:</strong> {{ $teacher->phone_number ?? 'N/A' }}</p>
            <p><strong>Linked User Account:</strong> {{ $teacher->user->name ?? 'N/A' }} ({{ $teacher->user->email ?? '' }})</p>
            <p><strong>Created At:</strong> {{ $teacher->created_at->format('d M Y, h:i A') }}</p>
            <p><strong>Updated At:</strong> {{ $teacher->updated_at->format('d M Y, h:i A') }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection
