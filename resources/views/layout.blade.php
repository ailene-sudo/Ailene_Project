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
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #1e4620;
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

        #navbarLinks {
            display: flex;
            align-items: center;
        }

        .navbar-links a {
            color: #ffffff;
            text-decoration: none;
            padding: 8px 14px;
            margin: 0 5px;
            border-radius: 4px;
            transition: background 0.3s ease;
            display: flex;
            align-items: center;
            font-size: 16px;
        }

        .navbar-links a i {
            margin-right: 6px;
            font-size: 16px;
        }

        .navbar-links a:hover {
            background-color: #388e3c;
        }

        .navbar-links .active {
            background-color: #388e3c;
        }

        .logout-btn {
            padding: 8px 14px;
            color: #ffffff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            border-radius: 4px;
            transition: background 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #388e3c;
            color: #ffffff;
        }

        .user-badge {
            padding: 8px 14px;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .user-badge i {
            margin-right: 5px;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 25px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            flex-grow: 1;
        }

        .footer {
            background-color: #1e4620;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: auto;
            font-size: 14px;
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

        .nav-right {
            display: flex;
            align-items: center;
            font-size: 16px;
        }

        /* Mobile navbar toggle */
        @media screen and (max-width: 768px) {
            .navbar-custom {
                flex-wrap: wrap;
            }
            
            .navbar-links {
                display: none;
                flex-direction: column;
                width: 100%;
                margin-top: 10px;
            }

            .navbar-links.active {
                display: flex;
            }

            .navbar-toggle {
                font-size: 26px;
                color: white;
                background: none;
                border: none;
                cursor: pointer;
            }

            .nav-right {
                display: none;
                flex-direction: column;
                align-items: flex-start;
                margin-top: 10px;
                width: 100%;
            }
            
            .nav-right.active {
                display: flex;
            }
            
            .user-badge {
                margin: 10px 0;
                width: 100%;
                justify-content: center;
            }
            
            .logout-btn {
                margin: 0;
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header with Navbar -->
    @section('navbar')
    <header>
        <div class="navbar-custom">
            <div class="navbar-title">Aster's Website</div>
            <div class="navbar-links d-none d-md-flex" id="navbarLinks">
                @if(session()->has('username'))
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                @endif
                <a href="{{ url('/profile') }}" class="{{ request()->is('profile') ? 'active' : '' }}">
                    <i class="bi bi-person"></i> Profile
                </a>
                <a href="{{ url('/aboutus') }}" class="{{ request()->is('aboutus') ? 'active' : '' }}">
                    <i class="bi bi-info-circle"></i> About Us
                </a>
                <a href="{{ url('/contactus') }}" class="{{ request()->is('contactus') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i> Contact Us
                </a>
                <a href="{{ url('/conditional') }}" class="{{ request()->is('conditional') ? 'active' : '' }}">
                    <i class="bi bi-code-slash"></i> Conditional
                </a>
                <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.index') ? 'active' : '' }}">
                    <i class="bi bi-mortarboard"></i> Students
                </a>
            </div>
            <button class="navbar-toggle d-md-none" onclick="toggleNavbar()">☰</button>
            @if(session()->has('username'))
            <div class="nav-right d-none d-md-flex">
                <a href="{{ route('logout') }}" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
            @endif
        </div>
    </header>
    @show

    <!-- Main Content -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Footer -->
    @section('footer')
    <footer class="footer">
        <p>© 2025 Aster's Website. All rights reserved.</p>
    </footer>
    @show

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleNavbar() {
            const links = document.getElementById('navbarLinks');
            links.classList.toggle('d-none');
            links.classList.toggle('active');
            
            // Also toggle the user options on mobile if user is logged in
            const navRight = document.querySelector('.nav-right');
            if (navRight) {
                navRight.classList.toggle('d-none');
                navRight.classList.toggle('active');
            }
        }
    </script>
</body>
</html>
