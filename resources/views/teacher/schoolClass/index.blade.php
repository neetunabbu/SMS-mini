@extends('teacher.layouts.app')

@section('content')
    <h2>School Classes</h2>
    
    <a href="{{ route('teacher.schoolClass.create') }}" class="btn btn-primary mb-3">Add New Class</a>
    
    @if ($classes->isEmpty())
        <p>No classes available.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Class Name</th>
                    <th>Subject</th>
                    <th>Teacher</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classes as $class)
                    <tr>
                        <td>{{ $class->name }}</td>
                        <td>{{ $class->subject }}</td>
                        {{-- <td>{{ $class->teacher->name }}</td> --}}
                        <td>{{ $class->teacher ? $class->teacher->name : 'Not Assigned' }}</td>

                        <td>
                            @if($class->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('teacher.schoolClass.edit', $class->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('teacher.schoolClass.show', $class->id) }}" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
