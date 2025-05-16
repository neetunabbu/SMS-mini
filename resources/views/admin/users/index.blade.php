@extends('layouts.app')

@section('content')
    <style>
        /* Style the Users Management heading */
        h2 {
            font-size: 1.75rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        /* Style the success alert */
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: none;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 1rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Style the Create New User button */
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Style the table container */
        .table-container {
            max-width: 900px; /* Keep the reduced table width */
            margin-left: 0; /* Align table to the left */
            margin-right: auto; /* Ensure right side doesn’t stretch */
        }

        /* Style the table */
        .table {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%; /* Ensure table fits within container */
        }

        .table thead {
            background-color: #f8f9fa;
            color: #333;
            font-weight: 600;
        }

        .table th, .table td {
            padding: 6px 10px; /* Compact padding */
            vertical-align: middle;
            font-size: 0.85rem; /* Compact font size */
        }

        .table tbody tr {
            transition: background-color 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f1f3f5;
        }

        /* Style the Edit and Delete buttons */
        .btn-warning, .btn-danger {
            padding: 5px 10px; /* Compact buttons */
            font-size: 0.8rem; /* Compact font size for buttons */
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            transform: scale(1.05);
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        /* Style the button container below the table */
        .button-container {
            max-width: 900px; /* Match table width */
            margin-left: 0; /* Align with the table */
            margin-right: auto;
            margin-top: 15px; /* Space between table and button */
        }

        /* Style the pagination */
        .pagination-container {
            max-width: 900px; /* Match table width */
            margin-left: 0; /* Align with the table */
            margin-right: auto;
            margin-top: 20px; /* Space between button and pagination */
        }

        .pagination .page-item .page-link {
            color: #007bff;
            border: 1px solid #dee2e6;
            padding: 8px 12px;
            transition: all 0.3s ease;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: #ffffff;
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }

        .pagination .page-item .page-link:hover {
            background-color: #e9ecef;
            border-color: #dee2e6;
        }
    </style>

    <h2>Users Management</h2>

     <div class="button-container">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Create New User</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">Edit</a>

                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- <div class="button-container">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Create New User</a>
    </div> --}}

    <div class="pagination-container">
        <div class="d-flex justify-content-center">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection