<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GarudaHub')</title>
    <style>
        * { box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
            color: #333;
        }

        nav {
            background: #173b65;
            padding: 16px 8%;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav form { margin-left: auto; }

        nav button {
            background: #c0392b;
            color: white;
            border: none;
            padding: 9px 14px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        main {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .container {
            background: white;
            padding: 24px;
            border-radius: 8px;
        }

        .btn {
            display: inline-block;
            padding: 9px 14px;
            background: #173b65;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-danger { background: #c0392b; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin: 6px 0 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .alert {
            padding: 12px;
            margin-bottom: 16px;
            background: #d4edda;
            color: #155724;
            border-radius: 4px;
        }

        .error {
            color: #c0392b;
            margin-top: -12px;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('projects.index') }}">GarudaHub</a>

        @auth
            <a href="{{ route('projects.index') }}">Projects</a>

            @if (auth()->user()->role === 'developer')
                <a href="{{ route('bids.index') }}">Bids</a>
            @endif

            @if (auth()->user()->role === 'klien')
                <a href="{{ route('projects.create') }}">Tambah Project</a>
            @endif

            <span style="color: white;">
                Halo, {{ auth()->user()->nama }}
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </nav>

    <main>
        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="container">
            @yield('content')
        </div>
    </main>
</body>
</html>
