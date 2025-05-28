<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aster\'s Website')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2b6777;      /* Dark teal */
            --secondary: #52ab98;    /* Mint green */
            --light: #c8d8e4;        /* Light blue-gray */
            --lighter: #f2f2f2;      /* Very light gray */
            --white: #ffffff;        /* White */
            --dark: #1f1f1f;         /* Dark for text */
            --success: #52ab98;      /* Using mint green for success */
            --danger: #dc3545;       /* Red for danger/logout */
            --header-bg: #006400;    /* Dark green for header */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            min-height: 100vh;
            background-color: var(--lighter);
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: var(--white);
            padding: 1rem;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        .nav-section {
            margin-bottom: 2rem;
        }

        .nav-section-title {
            color: #666;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
            padding: 0 0.5rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: var(--dark);
            text-decoration: none;
            border-radius: 0.5rem;
            margin-bottom: 0.25rem;
            transition: all 0.3s ease;
        }

        .nav-item:hover {
            background-color: var(--light);
            color: var(--primary);
        }

        .nav-item.active {
            background-color: #e8f5e9;
            color: var(--secondary);
        }

        .nav-item i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        /* Main Content Area */
        .main-container {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        .header {
            background-color: var(--header-bg);
            color: var(--white);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 1.5rem;
            display: flex;
            align-items: center;
        }

        .header h1 i {
            margin-right: 0.5rem;
        }

        /* Content Area */
        .content {
            padding: 2rem;
            flex: 1;
        }

        /* Dashboard Cards */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .card {
            background-color: var(--white);
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .card-header {
            color: var(--primary);
            font-size: 1.25rem;
            font-weight: 500;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--light);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--secondary);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--primary);
        }

        .btn-danger {
            background-color: var(--danger);
            color: var(--white);
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        /* Logout Button */
        .logout-btn {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--danger);
            color: var(--white);
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: auto;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }

        .logout-btn i {
            margin-right: 0.5rem;
        }

        /* Tables */
        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--white);
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .table th,
        .table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--light);
        }

        .table th {
            background-color: var(--primary);
            color: var(--white);
            font-weight: 500;
        }

        .table tr:hover {
            background-color: var(--lighter);
        }

        /* Forms */
        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--dark);
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--light);
            border-radius: 0.25rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
        }

        /* Alerts */
        .alert {
            padding: 1rem;
            border-radius: 0.25rem;
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: #e8f5e9;
            color: var(--success);
            border-left: 4px solid var(--success);
        }

        .alert-danger {
            background-color: #ffeaea;
            color: var(--danger);
            border-left: 4px solid var(--danger);
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="nav-section">
            <div class="nav-section-title">MAIN NAVIGATION</div>
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('students.index') }}" class="nav-item {{ request()->routeIs('students.*') ? 'active' : '' }}">
                <i class="bi bi-mortarboard"></i> Students
            </a>
            <a href="{{ route('conditional') }}" class="nav-item {{ request()->routeIs('conditional') ? 'active' : '' }}">
                <i class="bi bi-code-slash"></i> Conditional
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">INFORMATION</div>
            <a href="{{ route('profile') }}" class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                <i class="bi bi-person"></i> Profile
            </a>
            <a href="{{ route('aboutus') }}" class="nav-item {{ request()->routeIs('aboutus') ? 'active' : '' }}">
                <i class="bi bi-info-circle"></i> About Us
            </a>
            <a href="{{ route('contactus') }}" class="nav-item {{ request()->routeIs('contactus') ? 'active' : '' }}">
                <i class="bi bi-envelope"></i> Contact Us
            </a>
        </div>

        @if(session('username') === 'admin')
        <div class="nav-section">
            <div class="nav-section-title">ADMINISTRATION</div>
            <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <i class="bi bi-people"></i> User Management
            </a>
        </div>
        @endif

        <a href="{{ route('logout') }}" class="logout-btn">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <header class="header">
            <h1><i class="bi bi-flower1"></i> Aster's Website</h1>
            <div>
                @if(session('username'))
                    <span>Welcome, {{ session('username') }}!</span>
                @endif
            </div>
        </header>

        <main class="content">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html> 