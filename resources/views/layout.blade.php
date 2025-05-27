<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aster\'s Website')</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #1e4620;
            position: fixed;
            width: 100%;
            z-index: 1000;
        }

        .navbar-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 7px 17px;
            background-color: #1e4620;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-title {
            color: #ffffff;
            font-size: 22px;
            font-weight: 600;
            margin-right: 17px;
        }

        /* Sidebar styles */
        .sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            height: calc(100% - 60px);
            width: 240px;
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
            padding: 20px 0;
            z-index: 900;
            overflow-y: auto;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav li {
            margin: 5px 15px;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: #495057;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.2s;
        }

        .sidebar-nav a i {
            margin-right: 12px;
            font-size: 18px;
            color: #1e4620;
        }

        .sidebar-nav a:hover {
            background-color: #e9ecef;
        }

        .sidebar-nav a.active {
            background-color: #e8f5e9;
            color: #1e4620;
            font-weight: 500;
        }

        .sidebar-divider {
            height: 1px;
            background-color: #dee2e6;
            margin: 15px;
        }

        .sidebar-header {
            font-size: 11px;
            text-transform: uppercase;
            color: #6c757d;
            font-weight: 600;
            letter-spacing: 0.5px;
            padding: 0 15px;
            margin: 15px 15px 10px;
        }

        /* Main Content */
        .main-content {
            margin-left: 240px;
            padding-top: 80px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content-container {
            flex: 1;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            margin: 0 20px 20px 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            padding: 14px 18px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: #388e3c;
            color: white;
            font-size: 16px;
        }

        tbody tr:hover {
            background-color: #f1f8e9;
        }

        tbody tr:nth-child(even) {
            background-color: #e8f5e9;
        }

        .table-container {
            overflow-x: auto;
        }

        h1 {
            text-align: center;
            font-size: 28px;
            color: #333;
            margin-bottom: 25px;
        }

        .footer {
            background-color: #1e4620;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: auto;
            font-size: 14px;
        }

        /* Mobile styles */
        @media screen and (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Header with Navbar -->
    @section('navbar')
    <header>
        <div class="navbar-custom">
            <div class="navbar-title"><i class="bi bi-flower1 me-2"></i>Aster's Website</div>
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-outline-light d-md-none ms-2" id="mobileSidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>
    </header>
    @show

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <ul class="sidebar-nav">
            <div class="sidebar-header">MAIN NAVIGATION</div>
            
            @if(session()->has('username'))
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </li>
            @endif
            
            <li>
                <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.index') ? 'active' : '' }}">
                    <i class="bi bi-mortarboard"></i>
                    Students
                </a>
            </li>
            
            <li>
                <a href="{{ url('/conditional') }}" class="{{ request()->is('conditional') ? 'active' : '' }}">
                    <i class="bi bi-code-slash"></i>
                    Conditional
                </a>
            </li>
            
            <div class="sidebar-divider"></div>
            <div class="sidebar-header">INFORMATION</div>
            
            <li>
                <a href="{{ url('/profile') }}" class="{{ request()->is('profile') ? 'active' : '' }}">
                    <i class="bi bi-person"></i>
                    Profile
                </a>
            </li>
            
            <li>
                <a href="{{ url('/aboutus') }}" class="{{ request()->is('aboutus') ? 'active' : '' }}">
                    <i class="bi bi-info-circle"></i>
                    About Us
                </a>
            </li>
            
            <li>
                <a href="{{ url('/contactus') }}" class="{{ request()->is('contactus') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i>
                    Contact Us
                </a>
            </li>
            
            @if(session()->has('username'))
            <div class="sidebar-divider"></div>
            <div class="sidebar-header">ADMINISTRATION</div>
            
            <li>
                <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    User Management
                </a>
            </li>
            
            <li class="mt-2 mb-5">
                <a href="{{ route('logout') }}" style="background-color: #dc3545; color: white; font-weight: bold; font-size: 16px; padding: 12px 15px;">
                    <i class="bi bi-box-arrow-right" style="color: white;"></i>
                    Logout
                </a>
            </li>
            @endif
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <div class="content-container">
            @yield('content')
        </div>

        <!-- Footer -->
        @section('footer')
        <footer class="footer">
            <p>© 2025 Aster's Website. All rights reserved.</p>
        </footer>
        @show
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
            
            // Mobile sidebar toggle
            if (mobileSidebarToggle) {
                mobileSidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const isMobile = window.innerWidth < 768;
                if (isMobile && !sidebar.contains(event.target) && 
                    event.target !== mobileSidebarToggle && 
                    !mobileSidebarToggle.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>