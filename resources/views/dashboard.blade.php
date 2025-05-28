@extends('layouts.layout')

@section('title', 'Dashboard - Aster\'s Website')

@section('content')
<div class="dashboard-grid">
    <!-- Welcome Card -->
    <div class="card">
        <div class="card-header">
            <i class="bi bi-person-circle"></i> Welcome Back!
        </div>
        <p>{{ session('username') }}</p>
    </div>

    <!-- Quick Actions -->
    <div class="card">
        <div class="card-header">
            <i class="bi bi-lightning"></i> Quick Actions
        </div>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('students.index') }}" class="btn btn-primary">
                <i class="bi bi-mortarboard"></i> View Students
            </a>
            <a href="{{ route('profile') }}" class="btn btn-primary">
                <i class="bi bi-person"></i> My Profile
            </a>
        </div>
    </div>

    <!-- System Status -->
    <div class="card">
        <div class="card-header">
            <i class="bi bi-info-circle"></i> System Status
        </div>
        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
            <div class="badge badge-success">System Online</div>
            <div class="badge badge-success">Database Connected</div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="card">
    <div class="card-header">
        <i class="bi bi-clock-history"></i> Recent Activity
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Action</th>
                <th>Description</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Login</td>
                <td>User logged in successfully</td>
                <td>{{ now()->format('Y-m-d H:i:s') }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection 