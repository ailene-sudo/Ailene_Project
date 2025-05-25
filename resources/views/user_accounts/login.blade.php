<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aster's Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 40px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
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
        .btn-outline-success {
            color: #006400;
            border-color: #006400;
            padding: 10px;
            font-weight: 500;
        }
        .btn-outline-success:hover {
            background-color: #006400;
            border-color: #006400;
            color: white;
        }
        .links {
            margin-top: 25px;
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
        .alert-success {
            background-color: #e6ffe6;
            color: #006600;
            border-left: 4px solid #006600;
        }
        .alert-warning {
            background-color: #fff9e6;
            color: #cc7a00;
            border-left: 4px solid #cc7a00;
        }
        .session-alert {
            display: flex;
            align-items: center;
        }
        .alert-icon {
            margin-right: 10px;
            font-size: 1.5rem;
        }
        .form-control:focus {
            border-color: #006400;
            box-shadow: 0 0 0 0.2rem rgba(0, 100, 0, 0.25);
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
        .or-divider {
            margin: 20px 0;
            text-align: center;
            position: relative;
        }
        .or-divider:before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background-color: #e0e0e0;
            z-index: 1;
        }
        .or-divider span {
            background-color: white;
            padding: 0 15px;
            position: relative;
            z-index: 2;
            color: #777;
        }
        .default-password-note {
            font-size: 0.85rem;
            color: #666;
            margin-top: 5px;
            font-style: italic;
        }
        .password-input-group {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            color: #006400;
            cursor: pointer;
            padding: 0;
            z-index: 10;
        }
        .password-toggle:hover {
            color: #004d00;
        }
        .password-toggle:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="app-name">
            <h1>Aster's Website</h1>
            <p>Administrative Portal</p>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-shield-lock"></i> User Login</h4>
            </div>
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger session-alert">
                        <div class="alert-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
                        <div>{{ session('error') }}</div>
                    </div>
                @endif
                
                @if(session('success'))
                    <div class="alert alert-success session-alert">
                        <div class="alert-icon"><i class="bi bi-check-circle-fill"></i></div>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif
                
                @if(session('warning'))
                    <div class="alert alert-warning session-alert">
                        <div class="alert-icon"><i class="bi bi-exclamation-circle-fill"></i></div>
                        <div>{{ session('warning') }}</div>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="username" class="form-label"><i class="bi bi-person"></i> Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" 
                            id="username" name="username" value="{{ old('username') }}" required autofocus>
                        @error('username')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label"><i class="bi bi-key"></i> Password</label>
                        <div class="password-input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                id="password" name="password" required>
                            <button type="button" class="password-toggle" onclick="togglePasswordVisibility('password')">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <div class="default-password-note">
                            For student accounts, your default password is your Student ID followed by a hyphen and your first name (e.g., S-24-1-John).<br>
                            For other new users, your default password is <strong>changepass123</strong>
                        </div>
                    </div>
                    
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </button>
                    </div>
                </form>
                
                <div class="or-divider">
                    <span>OR</span>
                </div>
                
                <div class="d-grid">
                    <a href="{{ route('register') }}" class="btn btn-outline-success">
                        <i class="bi bi-person-plus"></i> Register New Account
                    </a>
                </div>
                
                <div class="links">
                    <p class="mb-0 text-muted">
                        If you're having trouble logging in, please contact your administrator.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4 text-muted">
            <small>&copy; {{ date('Y') }} Aster's Website. All rights reserved.</small>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        }
    </script>
</body>
</html> 