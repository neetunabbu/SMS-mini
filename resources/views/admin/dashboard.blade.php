@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 p-3 bg-dark text-white">
                <div class="list-group">
                    <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action bg-primary text-white">Dashboard</a>
                    <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action bg-info text-white">Manage Users</a>
                    <a href="#" class="list-group-item list-group-item-action bg-success text-white">Settings</a>
                    <a href="{{ route('admin.school_classes.index') }}" class="list-group-item list-group-item-action bg-warning text-white">School Classes</a>
                    <!-- Add other links as needed -->
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 p-4">
                <h2 class="text-primary">Welcome to the Admin Dashboard</h2>
                <p class="text-muted">Here you can manage users, settings, school classes, and more.</p>

                <!-- Recent Activity -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-info text-white">
                        Recent Activity
                    </div>
                    <div class="card-body">
                        <p class="text-muted">No recent activity yet.</p>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="row">
                    <!-- Total Users -->
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                Total Users
                            </div>
                            <div class="card-body">
                                <h4>150</h4> <!-- Replace with actual count -->
                                <p class="text-muted">All registered users.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Active Classes -->
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-header bg-success text-white">
                                Active Classes
                            </div>
                            <div class="card-body">
                                <h4>20</h4> <!-- Replace with actual count -->
                                <p class="text-muted">Classes currently being held.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests -->
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-header bg-warning text-dark">
                                Pending Requests
                            </div>
                            <div class="card-body">
                                <h4>5</h4> <!-- Replace with actual count -->
                                <p class="text-muted">Pending actions or requests.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Info or Widgets -->
                <div class="card mt-4 shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        Latest Updates
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check-circle"></i> New user registrations (5)</li>
                            <li><i class="fas fa-school"></i> 2 new classes created</li>
                            <li><i class="fas fa-cogs"></i> System settings updated</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
