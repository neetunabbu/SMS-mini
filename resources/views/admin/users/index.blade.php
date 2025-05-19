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

        /* Style the buttons */
        .btn-primary, .btn-danger {
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background-color: #003087;
        }

        .btn-primary:hover {
            background-color: #00205b;
            transform: scale(1.05);
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        /* Circular icon button */
        .icon-btn {
            padding: 8px !important;
            height: 38px !important;
            width: 38px !important;
            min-width: 38px !important;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px !important;
            transition: background-color 0.3s ease;
            border-radius: 50% !important;
        }

        .icon-btn i.material-icons {
            font-size: 18px;
            line-height: 1;
        }

        .icon-btn:hover {
            background-color: #00205b !important;
        }

        /* Style the table container */
        .table-container {
            max-width: 900px;
            margin-left: 0;
            margin-right: auto;
            margin-top: 20px;
        }

        /* Style the table */
        .table {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .table thead {
            background-color: #f8f9fa;
            color: #333;
            font-weight: 600;
        }

        .table th, .table td {
            padding: 6px 10px;
            vertical-align: middle;
            font-size: 0.85rem;
        }

        .table tbody tr {
            transition: background-color 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f1f3f5;
        }

        /* Style the Edit and Delete buttons */
        .btn-warning {
            font-weight: 500;
            transition: all 0.3s ease;
            background-color: #ffc107;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            transform: scale(1.05);
        }

        /* Add spacing between Edit and Delete buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        /* Checkbox styling */
        .sno-column {
            width: 80px !important;
            min-width: 80px !important;
            padding: 8px !important;
        }

        .sno-checkbox-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .sno-checkbox-container input[type="checkbox"] {
            width: 14px !important;
            height: 14px !important;
            margin: 0 !important;
            cursor: pointer;
            padding: 4px;
        }

        .table input[type="checkbox"] {
            display: inline-block !important;
            opacity: 1 !important;
        }

        /* Button container */
        .button-container {
            max-width: 900px;
            margin-left: 0;
            margin-right: auto;
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .button-container .d-flex {
            display: flex !important;
            gap: 10px;
        }

        .button-container .justify-content-end {
            justify-content: flex-end;
        }

        .btn-custom {
            padding: 8px 16px !important;
            height: 38px !important;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px !important;
            transition: background-color 0.3s ease;
        }

        .btn-custom i.material-icons {
            font-size: 16px;
            margin-right: 5px;
        }

        .btn-danger.btn-custom:hover {
            background-color: #c82333 !important;
        }

        /* Search and filter container */
        .search-filter-container {
            max-width: 900px;
            margin-left: 0;
            margin-right: auto;
            margin-bottom: 15px;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .search-filter-container input[type="text"],
        .search-filter-container select {
            padding: 8px 12px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .search-filter-container input[type="text"] {
            flex: 1;
        }

        .search-filter-container select {
            width: 150px;
        }

        .search-filter-container input[type="text"]:focus,
        .search-filter-container select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .search-filter-container .btn {
            padding: 8px 16px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: scale(1.05);
        }

        /* Pagination */
        .pagination-container {
            max-width: 900px;
            margin-left: 0;
            margin-right: auto;
            margin-top: 20px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination li a {
            color: #007bff;
            border: 1px solid #dee2e6;
            padding: 8px 12px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .pagination li.active a {
            background-color: #007bff;
            border-color: #007bff;
            color: #ffffff;
        }

        .pagination li.disabled a {
            color: #6c757d;
            background-color: #f8f9fa;
            border-color: #dee2e6;
            cursor: not-allowed;
        }

        .pagination li a:hover:not(.disabled a) {
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        @media (max-width: 768px) {
            .sno-column {
                width: 60px !important;
                min-width: 60px !important;
            }
            .sno-checkbox-container input[type="checkbox"] {
                width: 12px !important;
                height: 12px !important;
                padding: 3px;
            }
            .sno-checkbox-container {
                gap: 6px;
            }
            .button-container {
                flex-wrap: wrap;
                justify-content: center;
            }
            .button-container .d-flex {
                justify-content: center;
                margin-bottom: 10px;
            }
            .icon-btn {
                height: 36px !important;
                width: 36px !important;
            }
            .action-buttons {
                gap: 6px;
            }
            .search-filter-container {
                flex-wrap: wrap;
                justify-content: center;
            }
            .search-filter-container input[type="text"],
            .search-filter-container select {
                width: 100%;
                margin-bottom: 10px;
            }
            .search-filter-container .btn {
                width: 100%;
            }
        }
    </style>

    <h2>Users Management</h2>

    <!-- Search and Filter Form -->
    <div class="search-filter-container">
        <form action="{{ route('admin.users.index') }}" method="GET" style="display: flex; gap: 10px; width: 100%;">
            <input type="text" name="search" placeholder="Search by name, email, or role..." value="{{ request()->query('search') }}">
            <select name="role">
                <option value="all" {{ request()->query('role', 'all') === 'all' ? 'selected' : '' }}>All Roles</option>
                <option value="admin" {{ request()->query('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="teacher" {{ request()->query('role') === 'teacher' ? 'selected' : '' }}>Teacher</option>
                <option value="student" {{ request()->query('role') === 'student' ? 'selected' : '' }}>Student</option>
            </select>
            <button type="submit" class="btn btn-primary">Search</button>
            @if(request()->query('search') || (request()->query('role') && request()->query('role') !== 'all'))
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Clear</a>
            @endif
        </form>
    </div>

    <div class="button-container">
        <div class="d-flex">
            <button id="bulkDeleteButton" class="btn btn-danger btn-custom" disabled onclick="showBulkDeleteModal()">
                <i class="material-icons"></i> Bulk Delete
            </button>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary icon-btn waves-effect" title="Create New User">
                <i class="material-icons">+</i>
            </a>
        </div>
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
                    <th class="text-center sno-column"><input type="checkbox" id="selectAll"> S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                    <tr>
                        <td class="sno-column">
                            <div class="sno-checkbox-container">
                                <input type="checkbox" class="checkbox" value="{{ $user->id }}">
                                <span>{{ $index + $users->firstItem() }}</span>
                            </div>
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-custom">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-custom">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination-container">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    @if ($users->onFirstPage())
                        <li class="disabled"><a href="#">«</a></li>
                    @else
                        <li><a href="{{ $users->previousPageUrl() }}&search={{ urlencode(request()->get('search')) }}&role={{ urlencode(request()->get('role')) }}">«</a></li>
                    @endif

                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        @if ($page == $users->currentPage())
                            <li class="active"><a href="#">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}&search={{ urlencode(request()->get('search')) }}&role={{ urlencode(request()->get('role')) }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    @if ($users->hasMorePages())
                        <li><a href="{{ $users->nextPageUrl() }}&search={{ urlencode(request()->get('search')) }}&role={{ urlencode(request()->get('role')) }}">»</a></li>
                    @else
                        <li class="disabled"><a href="#">»</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>

    <!-- Bulk Delete Confirmation Modal -->
    <div class="modal fade" id="bulkDeleteModal" tabindex="-1" role="dialog"
         aria-labelledby="bulkDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h5 class="modal-title" id="bulkDeleteModalLabel">Confirm Bulk Delete</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the selected users?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmBulkDeleteButton">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="successModalBody">
                    <!-- Success message will be injected here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        // Bulk Actions Functionality
        $('#selectAll').on('change', function () {
            $('.checkbox').prop('checked', $(this).prop('checked'));
            toggleBulkActions();
        });

        $(document).on('change', '.checkbox', function () {
            toggleBulkActions();
            if ($('.checkbox:checked').length === $('.checkbox').length) {
                $('#selectAll').prop('checked', true);
            } else {
                $('#selectAll').prop('checked', false);
            }
        });

        function toggleBulkActions() {
            const selected = $('.checkbox:checked').length;
            $('#bulkDeleteButton').prop('disabled', selected === 0);
        }

        function getSelectedIds() {
            return $('.checkbox:checked').map(function () {
                return $(this).val();
            }).get();
        }

        function showBulkDeleteModal() {
            const ids = getSelectedIds();
            if (ids.length) {
                $('#bulkDeleteModal').modal('show');
            }
        }

        $('#confirmBulkDeleteButton').on('click', function () {
            const ids = getSelectedIds();
            $.post("{{ route('admin.users.bulkDelete') }}", {
                _token: "{{ csrf_token() }}",
                ids: ids
            }, function(response) {
                if (response.success) {
                    $('#successModalBody').text(response.message || 'Users deleted successfully.');
                    $('#successModal').modal('show');
                    $('#bulkDeleteModal').modal('hide');
                } else {
                    alert('An error occurred while deleting users.');
                }
            }).fail(function() {
                alert('An error occurred while deleting users.');
            });
        });

        $('#successModal').on('click', '.btn-primary', function() {
            location.reload();
        });

        setTimeout(function () {
            $('.alert').alert('close');
        }, 10000);
    </script>
@endsection