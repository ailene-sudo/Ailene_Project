<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Project')</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
            padding: 15px 30px;
            background-color: #1e4620;
        }

        .navbar-title {
            color: #ffffff;
            font-size: 24px;
            font-weight: 600;
        }

        .navbar-links a {
            color: #ffffff;
            text-decoration: none;
            padding: 10px 15px;
            margin-left: 10px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .navbar-links a:hover {
            background-color: #388e3c;
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

        /* Mobile navbar toggle */
        @media screen and (max-width: 768px) {
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
        }
    </style>
</head>
<body>
    <!-- Header with Navbar -->
    @section('navbar')
    <header>
        <div class="navbar-custom">
            <div class="navbar-title">Aster's Website</div>
            <button class="navbar-toggle d-md-none" onclick="toggleNavbar()">☰</button>
            <div class="navbar-links d-none d-md-flex" id="navbarLinks">
                <a href="{{ url('/profile') }}">Profile</a>
                <a href="{{ url('/aboutus') }}">About Us</a>
                <a href="{{ url('/contactus') }}">Contact Us</a>
                <a href="{{ url('/conditional') }}">Conditional Statement</a>
                <a href="{{ route('students.index') }}">Student Information</a>
            </div>
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
        <p>© 2025 Laravel Project. All rights reserved.</p>
        <!-- <p> Created by Ailene FL </p> -->
    </footer>
    @show

    <script>
        function toggleNavbar() {
            const links = document.getElementById('navbarLinks');
            links.classList.toggle('d-none');
            links.classList.toggle('active');
        }
    </script>
</body>
</html>
