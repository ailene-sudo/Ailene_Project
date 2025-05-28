<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles -->
    <style>
        :root {
            --primary: #2b6777;      /* Dark teal */
            --secondary: #52ab98;    /* Mint green */
            --light: #c8d8e4;        /* Light blue-gray */
            --lighter: #f2f2f2;      /* Very light gray */
            --white: #ffffff;        /* White */
            --background: var(--lighter);
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: var(--background);
            color: #333;
            min-height: 100vh;
        }

        .navbar {
            background-color: var(--primary);
            padding: 1rem;
            color: var(--white);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: var(--white);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .navbar a:hover {
            background-color: var(--secondary);
        }

        .main-content {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .btn {
            background-color: var(--secondary);
            color: var(--white);
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: var(--primary);
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid var(--light);
            border-radius: 4px;
            margin-top: 0.25rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }

        th, td {
            padding: 0.75rem;
            border-bottom: 1px solid var(--light);
            text-align: left;
        }

        th {
            background-color: var(--light);
            color: var(--primary);
        }

        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: var(--secondary);
            color: var(--white);
        }

        .alert-error {
            background-color: #ff6b6b;
            color: var(--white);
        }

        /* Card styles */
        .card {
            background-color: var(--white);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            border: 1px solid var(--light);
        }

        .card-header {
            color: var(--primary);
            font-size: 1.25rem;
            font-weight: 500;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--light);
        }

        /* Navigation pills */
        .nav-pills {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .nav-pill {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            color: var(--primary);
            text-decoration: none;
            transition: all 0.3s;
        }

        .nav-pill:hover,
        .nav-pill.active {
            background-color: var(--primary);
            color: var(--white);
        }

        /* Status badges */
        .badge {
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
        }

        .badge-success {
            background-color: var(--secondary);
            color: var(--white);
        }

        .badge-warning {
            background-color: #ffd43b;
            color: #664d03;
        }

        .badge-danger {
            background-color: #ff6b6b;
            color: var(--white);
        }
    </style>

    @stack('styles')
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div>
                <a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
            </div>
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                    <a href="{{ route('profile') }}">Profile</a>
                    <a href="{{ route('logout') }}">Logout</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <main class="main-content">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html> 