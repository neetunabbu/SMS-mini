<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Teacher Panel')</title>
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
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            color: #ffc107;
            font-weight: bold;
        }
        .content {
            margin-left: 250px;
            padding: 2rem;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h4 class="text-center mb-4">Teacher Panel</h4>
    <ul class="nav flex-column px-3">
        <!-- Dashboard -->
        <li class="nav-item">
            <a href="{{ route('teacher.dashboard') }}" class="nav-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
        </li>
    
        <!-- Attendance -->
        <li class="nav-item">
            <a href="{{ route('teacher.attendance.index') }}" class="nav-link {{ request()->routeIs('teacher.attendance.*') ? 'active' : '' }}">
                Attendance
            </a>
        </li>
    
        <!-- Marks -->
        <li class="nav-item">
            <a href="{{ route('teacher.marks.index') }}" class="nav-link {{ request()->routeIs('teacher.marks.*') ? 'active' : '' }}">
                Marks
            </a>
        </li>
    
        <!-- School Classes -->
        <li class="nav-item">
            <a href="{{ route('teacher.schoolClass.index') }}" class="nav-link {{ request()->routeIs('teacher.school-classes.*') ? 'active' : '' }}">
                School Classes
            </a>
        </li>
    
        <!-- Leave Approvals -->
        <li class="nav-item">
            <a href="{{ route('teacher.leaveApproval.index') }}" class="nav-link {{ request()->routeIs('teacher.leaveApproval.*') ? 'active' : '' }}">
                Leave Approvals
            </a>
        </li>
    
        <!-- Profile (Dropdown) -->
        <li class="nav-item dropdown mt-2">
            <a class="nav-link dropdown-toggle text-white {{ request()->routeIs('teacher.profile.*') || request()->routeIs('teacher.password.*') ? 'active' : '' }}" 
               href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Profile
            </a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="profileDropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('teacher.profile.show') }}">View Profile</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('teacher.profile.edit') }}">Edit Profile</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('teacher.profile.password') }}">Change Password</a>
                </li>
            </ul>
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
