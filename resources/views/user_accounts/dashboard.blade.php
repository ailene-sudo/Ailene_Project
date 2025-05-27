@extends('layout')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mt-5 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-success text-white">
                    <h4 class="mb-0"><i class="bi bi-speedometer2"></i> Dashboard</h4>
                    
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong><i class="bi bi-check-circle"></i> Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <div class="text-center mb-4">
                        <div class="display-6 mb-3"><i class="bi bi-person-circle"></i></div>
                        <h4>Welcome, <strong>{{ $username }}</strong>!</h4>
                        <p class="text-muted">You are now logged into the Aster's Website admin system.</p>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card mb-3 h-100 border-0 shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="bi bi-person-gear"></i> User Options</h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group list-group-flush">
                                        <a href="{{ route('profile') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                            <i class="bi bi-person me-3 text-primary"></i>
                                            <div>
                                                <strong>View Profile</strong>
                                                <div class="small text-muted">View and manage your account details</div>
                                            </div>
                                        </a>
                                        <a href="{{ route('password.update') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                            <i class="bi bi-key me-3 text-warning"></i>
                                            <div>
                                                <strong>Change Password</strong>
                                                <div class="small text-muted">Update your account password</div>
                                            </div>
                                        </a>
                                        <a href="{{ route('aboutus') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                            <i class="bi bi-info-circle me-3 text-info"></i>
                                            <div>
                                                <strong>About Us</strong>
                                                <div class="small text-muted">Learn more about our organization</div>
                                            </div>
                                        </a>
                                        <a href="{{ route('contactus') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                            <i class="bi bi-envelope me-3 text-success"></i>
                                            <div>
                                                <strong>Contact Us</strong>
                                                <div class="small text-muted">Send messages to our support team</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header bg-dark text-white">
                                    <h5 class="mb-0"><i class="bi bi-gear-wide-connected"></i> System Functions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group list-group-flush">
                                        <a href="{{ route('students.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                            <i class="bi bi-mortarboard me-3 text-primary"></i>
                                            <div>
                                                <strong>Manage Students</strong>
                                                <div class="small text-muted">Add, edit, and view student records</div>
                                            </div>
                                        </a>
                                        <a href="{{ route('conditional') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                            <i class="bi bi-code-slash me-3 text-secondary"></i>
                                            <div>
                                                <strong>Conditional Logic</strong>
                                                <div class="small text-muted">View conditional statement examples</div>
                                            </div>
                                        </a>
                                        <a href="{{ route('pattern') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                            <i class="bi bi-grid-3x3 me-3 text-warning"></i>
                                            <div>
                                                <strong>Pattern Generator</strong>
                                                <div class="small text-muted">Generate pattern layouts</div>
                                            </div>
                                        </a>
                                        <a href="{{ route('admin.users') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                            <i class="bi bi-people me-3 text-danger"></i>
                                            <div>
                                                <strong>User Management</strong>
                                                <div class="small text-muted">Manage system user accounts</div>
                                            </div>
                                        </a>
                                        <a href="{{ route('admin.users.create') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                            <i class="bi bi-person-plus me-3 text-success"></i>
                                            <div>
                                                <strong>Register New Account</strong>
                                                <div class="small text-muted">Create a new user account</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted text-center">
                    <small>Last login: {{ session('last_activity') ? \Carbon\Carbon::parse(session('last_activity'))->format('Y-m-d H:i:s') : 'Unknown' }}</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 