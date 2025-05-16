<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Ensure the body takes up full height and has no default margin */
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa; /* Light gray background for the whole page */
        }

        /* Fix the sidebar to the left and make it full height */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px; /* Fixed width for the sidebar */
            background-color: #212529; /* Dark background for sidebar */
            padding-top: 20px;
            overflow-y: auto; /* Allow scrolling if content overflows */
        }

        /* Style the sidebar header */
        #sidebar h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #ffffff;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Style the sidebar menu items */
        #sidebar .nav-link {
            color: #adb5bd; /* Light gray text for menu items */
            font-size: 1.1rem;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        #sidebar .nav-link:hover {
            color: #ffffff; /* White text on hover */
            background-color: #343a40; /* Slightly lighter dark background on hover */
            border-radius: 5px;
        }

        /* Style the active menu item (optional, if you want to highlight the current page) */
        #sidebar .nav-link.active {
            color: #ffffff;
            background-color: #007bff; /* Blue background for active item */
            border-radius: 5px;
        }

        /* Style the dropdown menu */
        #sidebar .dropdown-menu {
            background-color: #343a40; /* Match sidebar background */
            border: none;
            border-radius: 5px;
            margin-left: 10px;
        }

        #sidebar .dropdown-item {
            color: #adb5bd; /* Light gray text for dropdown items */
            padding: 8px 20px;
        }

        #sidebar .dropdown-item:hover {
            color: #ffffff;
            background-color: #495057; /* Slightly lighter background on hover */
        }

        /* Style the logout button */
        #sidebar .btn-danger {
            font-weight: 500;
            transition: all 0.3s ease;
        }

        #sidebar .btn-danger:hover {
            background-color: #dc3545; /* Slightly darker red on hover */
            transform: scale(1.05); /* Slight scale effect on hover */
        }

        /* Adjust the main content to account for the fixed sidebar */
        .main-content {
            margin-left: 250px; /* Match sidebar width */
            padding: 30px;
            background-color: #ffffff; /* White background for content area */
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }

        /* Ensure the container-fluid takes up full width */
        .container-fluid {
            padding: 0;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 bg-dark text-white p-3 min-vh-100" id="sidebar">
            <h3 class="mb-4">Admin Dashboard</h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profile
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.profile.show') }}">View Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">Edit Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.password.edit') }}">Change Password</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.users.index') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.students.index') }}">Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.teachers.index') }}">Teachers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.attendances.index') }}">Attendance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.marks.index') }}">Marks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.leaves.index') }}">Leave Approval</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.school_classes.index') }}">School Classes</a>
                </li>
                <li class="nav-item">
                    {{-- <a class="nav-link text-white" href="#">Roles & Permissions</a> --}}
                </li>
                <!-- Logout Button -->
                <li class="nav-item mt-3">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>