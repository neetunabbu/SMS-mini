<aside class="sidebar p-3" style="width: 250px; background-color: #0d6efd; color: white;">
    <div class="h5 mb-4 border-bottom pb-2">SMS Menu</div>
    <nav class="nav flex-column">
        <a class="nav-link text-white" href="{{ route('dashboard') }}">Dashboard</a>

        @if(auth()->user()->role === 'admin')
            <a class="nav-link text-white" href="#">Manage Users</a>
            <a class="nav-link text-white" href="#">Classes</a>
        @elseif(auth()->user()->role === 'teacher')
            <a class="nav-link text-white" href="#">My Classes</a>
            <a class="nav-link text-white" href="#">Mark Attendance</a>
        @elseif(auth()->user()->role === 'student')
            <a class="nav-link text-white" href="#">My Subjects</a>
            <a class="nav-link text-white" href="#">View Attendance</a>
        @endif
    </nav>
</aside>

<!-- Bootstrap JS and Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
