<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Aster's Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 40px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .register-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
        }
        .card-header {
            background-color: #006400;
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
            border-bottom: none;
        }
        .btn-primary {
            background-color: #006400;
            border-color: #006400;
            padding: 10px;
            font-weight: 500;
        }
        .btn-primary:hover {
            background-color: #004d00;
            border-color: #004d00;
        }
        .links {
            margin-top: 15px;
            text-align: center;
        }
        .links a {
            color: #006400;
            text-decoration: none;
            font-weight: 500;
        }
        .links a:hover {
            text-decoration: underline;
        }
        .alert {
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            border: none;
        }
        .alert-danger {
            background-color: #ffe6e6;
            color: #cc0000;
            border-left: 4px solid #cc0000;
        }
        .alert-info {
            background-color: #e8f4f8;
            color: #17a2b8;
            border-left: 4px solid #17a2b8;
        }
        .app-name {
            text-align: center;
            margin-bottom: 30px;
            color: #006400;
        }
        .app-name h1 {
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 5px;
        }
        .app-name p {
            color: #555;
            font-size: 1rem;
            font-weight: 400;
        }
        .password-notice {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin-top: 20px;
        }
        .password-notice h6 {
            color: #006400;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container register-container">
        <div class="app-name">
            <h1>Aster's Website</h1>
            <p>Account Registration</p>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-person-plus"></i> Register New Account</h4>
            </div>
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger">
                        <strong><i class="bi bi-exclamation-triangle-fill"></i> Error!</strong> {{ session('error') }}
                    </div>
                @endif
                
                <div class="alert alert-info mb-4">
                    <strong><i class="bi bi-info-circle"></i> Note:</strong> After registration, you'll be assigned a default password. You'll need to change it on your first login.
                </div>
                
                <form method="POST" action="{{ route('register.submit') }}" class="needs-validation" novalidate>
                    @csrf
                    
                    <div class="mb-4">
                        <label for="username" class="form-label"><i class="bi bi-person"></i> Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" 
                            id="username" name="username" value="{{ old('username') }}" 
                            pattern=".{4,}" title="Username must be at least 4 characters" 
                            required autofocus>
                        @error('username')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <div class="form-text">
                            Username must be at least 4 characters and unique.
                        </div>
                    </div>
                    
                    <div class="password-notice">
                        <h6><i class="bi bi-shield-lock"></i> Password Information</h6>
                        <p class="mb-0">Your default password will be: <strong>changepass123</strong></p>
                        <p class="mb-0">You'll be prompted to change this password after your first login.</p>
                    </div>
                    
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-person-plus-fill"></i> Register Account
                        </button>
                    </div>
                </form>
                
                <div class="links">
                    Already have an account? <a href="{{ route('login') }}">Login here</a>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4 text-muted">
            <small>&copy; {{ date('Y') }} Aster's Website. All rights reserved.</small>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
</body>
</html> 