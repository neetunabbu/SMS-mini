@extends('layouts.app')

@section('content')
    <style>
        /* Style the Students List heading */
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
        .btn-primary, .btn-danger, .btn-warning, .btn-info {
            padding: 6px 12px;
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

        .btn-warning {
            background-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            transform: scale(1.05);
        }

        .btn-info {
            background-color: #17a2b8;
        }

        .btn-info:hover {
            background-color: #138496;
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
            max-width: 800px; /* Match table width */
            margin-left: 0; /* Align to the left */
            margin-right: auto;
            margin-top: 30px; /* Add space above the table to move it down */
        }

        /* Style the table */
        .table {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px; /* Reduced table width */
            margin-left: 0; /* Align to the left */
        }

        .table thead {
            background-color: #f8f9fa;
            color: #333;
            font-weight: 600;
        }

        .table th, .table td {
            padding: 4px 8px;
            vertical-align: middle;
            font-size: 0.8rem;
        }

        .table tbody tr {
            transition: background-color 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f1f3f5;
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
            max-width: 800px; /* Match table width */
            margin-left: 0; /* Align to the left */
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

        /* Pagination */
        .pagination-container {
            max-width: 800px; /* Match table width */
            margin-left: 0; /* Align to the left */
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
            .table th, .table td {
                padding: 3px 6px;
                font-size: 0.75rem;
            }

            .btn-sm {
                padding: 4px 8px;
                font-size: 0.8rem;
            }

            .pagination li a {
                padding: 6px 10px;
            }

            .icon-btn {
                height: 36px !important;
                width: 36px !important;
            }

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
        }
    </style>

    <h2>Students List</h2>

    @if(session('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif

    <div class="button-container">
        <div class="d-flex">
            <button id="bulkDeleteButton" class="btn btn-danger btn-custom" disabled onclick="showBulkDeleteModal()">
                <i class="material-icons"></i> Bulk Delete
            </button>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.students.create') }}" class="btn btn-primary icon-btn waves-effect" title="Create New Student">
                <i class="material-icons">+</i>
            </a>
        </div>
    </div>

    <div class="table-container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center sno-column"><input type="checkbox" id="selectAll"> #</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roll Number</th>
                    <th>Class</th>
                    <th>Teacher</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($students as $key => $student)
                <tr>
                    <td class="sno-column">
                        <div class="sno-checkbox-container">
                            <input type="checkbox" class="checkbox" value="{{ $student->id }}">
                            <span>{{ $key + $students->firstItem() }}</span>
                        </div>
                    </td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->roll_number }}</td>
                    <td>{{ $student->schoolClass ? $student->schoolClass->name : '-' }}</td>
                    <td>{{ $student->teacher ? $student->teacher->name : '-' }}</td>
                    <td>
                        <a href="{{ route('admin.students.show', $student->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No students found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                @if ($students->onFirstPage())
                    <li class="disabled"><a href="#">«</a></li>
                @else
                    <li><a href="{{ $students->previousPageUrl() }}">«</a></li>
                @endif

                @foreach ($students->getUrlRange(1, $students->lastPage()) as $page => $url)
                    @if ($page == $students->currentPage())
                        <li class="active"><a href="#">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                @if ($students->hasMorePages())
                    <li><a href="{{ $students->nextPageUrl() }}">»</a></li>
                @else
                    <li class="disabled"><a href="#">»</a></li>
                @endif
            </ul>
        </nav>
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
                    Are you sure you want to delete the selected students?
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
            $.post("{{ route('admin.students.bulkDelete') }}", {
                _token: "{{ csrf_token() }}",
                ids: ids
            }, function(response) {
                if (response.success) {
                    $('#successModalBody').text(response.message || 'Students deleted successfully.');
                    $('#successModal').modal('show');
                    $('#bulkDeleteModal').modal('hide');
                } else {
                    alert('An error occurred while deleting students.');
                }
            }).fail(function() {
                alert('An error occurred while deleting students.');
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