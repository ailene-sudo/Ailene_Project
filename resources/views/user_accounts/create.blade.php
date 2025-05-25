@extends('layout')

@section('title', 'Create User Account')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-person-plus"></i> Create User Account</h4>
                    <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-light">
                        <i class="bi bi-arrow-left"></i> Back to Users
                    </a>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong><i class="bi bi-exclamation-triangle"></i> Error!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <div class="alert alert-info mb-4">
                        <strong><i class="bi bi-info-circle"></i> Note:</strong> New users will receive the default password "Changepass123" and will be required to change it upon first login.
                    </div>
                    
                    <form method="POST" action="{{ route('admin.users.store') }}" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="mb-4">
                            <label for="username" class="form-label fw-bold">Username</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" 
                                    id="username" name="username" value="{{ old('username') }}" 
                                    pattern=".{4,}" title="Username must be at least 4 characters" 
                                    required autofocus>
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-text">
                                <ul class="mb-0 ps-3 small">
                                    <li>Username must be at least 4 characters</li>
                                    <li>Must be unique in the system</li>
                                    <li>Will be used for login credentials</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title"><i class="bi bi-key"></i> Default Password</h6>
                                    <p class="card-text text-muted mb-0">
                                        The user will be assigned the password: <strong>Changepass123</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2">
                                <i class="bi bi-person-plus-fill"></i> Create User Account
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset Form
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
@endsection 