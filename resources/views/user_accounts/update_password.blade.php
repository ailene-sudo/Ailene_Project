<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password - Aster's Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 40px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .password-container {
            max-width: 550px;
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
        .alert-info {
            background-color: #e8f4f8;
            border-color: #b8e0ed;
            border-left: 4px solid #17a2b8;
        }
        .alert-warning {
            background-color: #fff9e6;
            color: #cc7a00;
            border-left: 4px solid #cc7a00;
        }
        .strength-meter {
            height: 8px;
            background-color: #eee;
            border-radius: 4px;
            margin-top: 8px;
            position: relative;
            overflow: hidden;
        }
        .strength-meter::before {
            content: '';
            height: 100%;
            width: 0;
            background-color: #dc3545;
            position: absolute;
            border-radius: 4px;
            transition: width 0.3s, background-color 0.3s;
        }
        .strength-meter.weak::before {
            width: 25%;
            background-color: #dc3545;
        }
        .strength-meter.medium::before {
            width: 50%;
            background-color: #ffc107;
        }
        .strength-meter.strong::before {
            width: 75%;
            background-color: #28a745;
        }
        .strength-meter.very-strong::before {
            width: 100%;
            background-color: #28a745;
        }
        .strength-text {
            text-align: right;
            font-size: 12px;
            margin-top: 5px;
            color: #666;
        }
        .password-requirements {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin-top: 15px;
        }
        .password-requirements ul {
            margin-bottom: 0;
            padding-left: 25px;
        }
        .password-requirements li {
            margin-bottom: 5px;
            color: #555;
        }
        .password-requirements li.valid {
            color: #28a745;
        }
        .password-requirements li.valid i {
            color: #28a745;
        }
        .password-requirements li.invalid {
            color: #dc3545;
        }
        .password-requirements li.invalid i {
            color: #dc3545;
        }
        .input-group-text {
            background-color: #f8f9fa;
            cursor: pointer;
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
        .restricted-access {
            background-color: #ffeee6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid #ff6b35;
        }
        .restricted-access h5 {
            color: #ff6b35;
            margin-bottom: 10px;
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
    <div class="container password-container">
        <div class="app-name">
            <h1>Aster's Website</h1>
            <p>Password Update</p>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-shield-lock"></i> Update Password</h4>
            </div>
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger">
                        <strong><i class="bi bi-exclamation-triangle-fill"></i> Error!</strong> {{ session('error') }}
                    </div>
                @endif
                
                @if(session('warning'))
                    <div class="alert alert-warning">
                        <strong><i class="bi bi-exclamation-circle-fill"></i> Warning!</strong> {{ session('warning') }}
                    </div>
                @endif
                
                @if(isset($isDefaultPassword) && $isDefaultPassword)
                <div class="restricted-access">
                    <h5><i class="bi bi-shield-exclamation"></i> Action Required</h5>
                    <p class="mb-0">Your account is using a default password. You must change your password before accessing the system.</p>
                </div>
                
                <div class="alert alert-info mb-4">
                    <strong><i class="bi bi-info-circle"></i> Important:</strong> 
                    @if($userRole === 'student')
                        For student accounts, your default password is your Student ID followed by a hyphen and your first name (e.g., S-24-1-John).
                    @else
                        For users, your default password is <strong>changepass123</strong>.
                    @endif
                    Please update it to a new secure password.
                </div>
                @else
                <div class="alert alert-info mb-4">
                    <strong><i class="bi bi-info-circle"></i> Information:</strong> You are changing your password. Please enter your current password and choose a new secure password.
                </div>
                @endif
                
                <form method="POST" action="{{ route('password.update.submit') }}" class="needs-validation" novalidate>
                    @csrf
                    
                    <div class="mb-3">
                        <label for="current_password" class="form-label"><i class="bi bi-key"></i> Current Password</label>
                        <div class="password-input-group">
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                id="current_password" name="current_password" required autofocus
                                @if(isset($isDefaultPassword) && $isDefaultPassword) value="{{ $defaultPassword }}" @endif>
                            <button type="button" class="password-toggle" onclick="togglePasswordVisibility('current_password')">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if(isset($isDefaultPassword) && $isDefaultPassword)
                        <div class="form-text">Default password has been pre-filled for you.</div>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label"><i class="bi bi-lock"></i> New Password</label>
                        <div class="password-input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                id="password" name="password" required>
                            <button type="button" class="password-toggle" onclick="togglePasswordVisibility('password')">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="strength-meter mt-2" id="strength-meter"></div>
                        <div class="strength-text" id="strength-text">Password strength</div>
                    </div>
                    
                    <div class="password-requirements">
                        <p class="mb-2"><strong>Password Requirements:</strong></p>
                        <ul>
                            <li id="length"><i class="bi bi-x-circle"></i> At least 8 characters long</li>
                            <li id="uppercase"><i class="bi bi-x-circle"></i> At least one uppercase letter</li>
                            <li id="lowercase"><i class="bi bi-x-circle"></i> At least one lowercase letter</li>
                            <li id="number"><i class="bi bi-x-circle"></i> At least one number</li>
                            <li id="special"><i class="bi bi-x-circle"></i> At least one special character</li>
                        </ul>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label"><i class="bi bi-lock"></i> Confirm New Password</label>
                        <div class="password-input-group">
                            <input type="password" class="form-control" 
                                id="password_confirmation" name="password_confirmation" required>
                            <button type="button" class="password-toggle" onclick="togglePasswordVisibility('password_confirmation')">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary" id="updateBtn">
                            <i class="bi bi-check-lg"></i> Update Password
                        </button>
                    </div>
                </form>
                
                @if(!isset($isDefaultPassword) || !$isDefaultPassword)
                <div class="links mt-3">
                    <a href="{{ route('dashboard') }}"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
                </div>
                @endif
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

        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const meter = document.getElementById('strength-meter');
            const text = document.getElementById('strength-text');
            
            // Update requirements
            document.getElementById('length').classList.toggle('valid', password.length >= 8);
            document.getElementById('uppercase').classList.toggle('valid', /[A-Z]/.test(password));
            document.getElementById('lowercase').classList.toggle('valid', /[a-z]/.test(password));
            document.getElementById('number').classList.toggle('valid', /\d/.test(password));
            document.getElementById('special').classList.toggle('valid', /[^A-Za-z0-9]/.test(password));
            
            // Update icons
            document.querySelectorAll('.password-requirements li').forEach(li => {
                const icon = li.querySelector('i');
                if (li.classList.contains('valid')) {
                    icon.classList.remove('bi-x-circle');
                    icon.classList.add('bi-check-circle-fill');
                } else {
                    icon.classList.remove('bi-check-circle-fill');
                    icon.classList.add('bi-x-circle');
                }
            });
            
            // Calculate strength
            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            // Update meter
            meter.className = 'strength-meter';
            if (strength >= 5) {
                meter.classList.add('very-strong');
                text.textContent = 'Very Strong';
            } else if (strength >= 4) {
                meter.classList.add('strong');
                text.textContent = 'Strong';
            } else if (strength >= 3) {
                meter.classList.add('medium');
                text.textContent = 'Medium';
            } else if (strength >= 2) {
                meter.classList.add('weak');
                text.textContent = 'Weak';
            } else {
                text.textContent = 'Very Weak';
            }
        });

        // Password confirmation matcher
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmation = this.value;
            
            if (confirmation && confirmation !== password) {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
            } else if (confirmation) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            } else {
                this.classList.remove('is-invalid', 'is-valid');
            }
        });
    </script>
</body>
</html> 