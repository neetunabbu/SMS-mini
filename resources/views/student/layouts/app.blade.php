<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Panel')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            color: white;
            padding-top: 1rem;
        }

        .sidebar .nav-link {
            color: white;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            color: #ffc107;
            font-weight: bold;
        }

        .content {
            margin-left: 250px;
            padding: 2rem;
        }

        .sidebar h4 {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .sidebar .nav-item {
            margin-bottom: 1rem;
        }

        .sidebar .btn-danger {
            font-size: 1rem;
            padding: 0.5rem;
        }

        .nav-link {
            font-size: 1.1rem;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h4 class="text-center mb-4">Student Panel</h4>
        <ul class="nav flex-column px-3">
            <li class="nav-item">
                <a href="{{ route('student.dashboard') }}" class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('student.attendance') }}" class="nav-link {{ request()->routeIs('student.attendance') ? 'active' : '' }}">
                    Attendance
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('student.marks') }}" class="nav-link {{ request()->routeIs('student.marks') ? 'active' : '' }}">
                    Marks
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('student.leaveApproval') }}" class="nav-link {{ request()->routeIs('student.leaveApproval') ? 'active' : '' }}">
                    Leave Request
                </a>
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

    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
