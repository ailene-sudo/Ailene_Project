@extends('layout')

@section('title', 'User Management')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h4 class="mb-0">User Management</h4>
                    <div>
                        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-light me-2">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-light">
                            <i class="bi bi-person-plus"></i> Add New User
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong><i class="bi bi-check-circle"></i> Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong><i class="bi bi-exclamation-triangle"></i> Error!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <!-- User Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">Total Users</h6>
                                        <h3 class="mb-0">{{ count($users) }}</h3>
                                    </div>
                                    <i class="bi bi-people fs-1"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-dark">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">Default Passwords</h6>
                                        <h3 class="mb-0">{{ $users->where('defaultpassword', true)->count() }}</h3>
                                    </div>
                                    <i class="bi bi-shield-exclamation fs-1"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">Custom Passwords</h6>
                                        <h3 class="mb-0">{{ $users->where('defaultpassword', false)->count() }}</h3>
                                    </div>
                                    <i class="bi bi-shield-check fs-1"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">Last Created</h6>
                                        <p class="mb-0">{{ $users->count() > 0 ? $users->sortByDesc('created_at')->first()->created_at->diffForHumans() : 'N/A' }}</p>
                                    </div>
                                    <i class="bi bi-clock-history fs-1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Search and Filter -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" id="userSearch" class="form-control" placeholder="Search by username...">
                                <button class="btn btn-primary" type="button">
                                    <i class="bi bi-search"></i> Search
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary active" onclick="filterUsers('all')">All Users</button>
                                <button type="button" class="btn btn-outline-warning" onclick="filterUsers('default')">Default Password</button>
                                <button type="button" class="btn btn-outline-success" onclick="filterUsers('custom')">Custom Password</button>
                            </div>
                        </div>
                    </div>
                    
                    @if(count($users) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="usersTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>User Account ID</th>
                                        <th>Username</th>
                                        <th>Password Status</th>
                                        <th>Created</th>
                                        <th>Last Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-dark">
                                    @foreach($users as $user)
                                        <tr class="user-row {{ $user->defaultpassword ? 'default-password' : 'custom-password' }}">
                                            <td>{{ $user->id }}</td>
                                            <td>
                                                @if($user->user_account_id)
                                                    <span class="badge bg-success">{{ $user->user_account_id }}</span>
                                                @else
                                                    <span class="badge bg-secondary">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $user->username }}</strong>
                                            </td>
                                            <td>
                                                @if($user->defaultpassword)
                                                    <span class="badge bg-warning text-dark">Default</span>
                                                @else
                                                    <span class="badge bg-success">Custom</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                            <td>{{ $user->updated_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button type="button" class="btn btn-outline-primary" title="View Details" onclick="viewUserDetails({{ $user->id }})">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-info" title="Edit User">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-outline-warning" title="Reset Password" onclick="resetPassword({{ $user->id }})">
                                                        <i class="bi bi-key"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger" title="Delete User" onclick="deleteUser({{ $user->id }})">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-center mt-4">
                            {{ $users->links() }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> No user accounts found. <a href="{{ route('admin.users.create') }}" class="alert-link">Create one now</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for User Details -->
<div class="modal fade" id="userDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">User Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-dark">
                <div id="userDetailContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Search functionality
    document.getElementById('userSearch').addEventListener('keyup', function() {
        let searchText = this.value.toLowerCase();
        let tableRows = document.querySelectorAll('#usersTable tbody tr');
        
        tableRows.forEach(row => {
            let username = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            if (username.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    
    // Filter users by password status
    function filterUsers(filter) {
        let tableRows = document.querySelectorAll('#usersTable tbody tr');
        
        tableRows.forEach(row => {
            if (filter === 'all') {
                row.style.display = '';
            } else if (filter === 'default' && row.classList.contains('default-password')) {
                row.style.display = '';
            } else if (filter === 'custom' && row.classList.contains('custom-password')) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        
        // Update active button
        document.querySelectorAll('.btn-group .btn').forEach(btn => {
            btn.classList.remove('active');
        });
        event.target.classList.add('active');
    }
    
    // Mock functions for the buttons (would need to be implemented with actual AJAX calls)
    function viewUserDetails(userId) {
        // Get the row that was clicked
        let userRow = document.querySelector(`#usersTable tbody tr:nth-child(${userId})`);
        
        // Extract user data from the table row
        let id = userRow.cells[0].textContent.trim();
        let username = userRow.cells[2].textContent.trim();
        let passwordStatus = userRow.cells[3].innerHTML.trim();
        let created = userRow.cells[4].textContent.trim();
        let updated = userRow.cells[5].textContent.trim();
        
        // Update the modal content
        let userDetailContent = document.getElementById('userDetailContent');
        userDetailContent.innerHTML = `
            <div class="text-center mb-3">
                <i class="bi bi-person-circle" style="font-size: 4rem;"></i>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr class="bg-light">
                        <th class="text-dark">User ID</th>
                        <td class="text-dark">${id}</td>
                    </tr>
                    <tr>
                        <th class="text-dark">Username</th>
                        <td class="text-dark">${username}</td>
                    </tr>
                    <tr class="bg-light">
                        <th class="text-dark">Password Status</th>
                        <td class="text-dark">${passwordStatus}</td>
                    </tr>
                    <tr>
                        <th class="text-dark">Created</th>
                        <td class="text-dark">${created}</td>
                    </tr>
                    <tr class="bg-light">
                        <th class="text-dark">Last Updated</th>
                        <td class="text-dark">${updated}</td>
                    </tr>
                </table>
            </div>
        `;
        
        // Show the modal
        var myModal = new bootstrap.Modal(document.getElementById('userDetailsModal'));
        myModal.show();
    }
    
    function resetPassword(userId) {
        if (confirm('Are you sure you want to reset this user\'s password to the default "Changepass123"?')) {
            // In a real app, this would make an AJAX call to reset the password
            alert('Password has been reset to "Changepass123". The user will be prompted to change it on next login.');
        }
    }
    
    function deleteUser(userId) {
        if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
            // Create a form and submit it to delete the user
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/users/' + userId;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endsection 