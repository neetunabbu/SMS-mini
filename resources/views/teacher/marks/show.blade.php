@extends('teacher.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Class Details: {{ $class->name }}</h2>

    <div class="card mb-3">
        <div class="card-body">
            <h5>Subject: {{ $class->subject }}</h5>
            <p>Section: {{ $class->section }}</p>
            <p>Class Code: {{ $class->class_code ?? 'N/A' }}</p>
            <p>Description: {{ $class->description ?? 'N/A' }}</p>
            <p>Status: {{ $class->is_active ? 'Active' : 'Inactive' }}</p>
            <p>Student Count: {{ $class->students->count() }}</p>
        </div>
    </div>

    <h4>Students List</h4>
    @if ($class->students->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($class->students as $index => $student)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No students found in this class.</p>
    @endif
</div>
@endsection
