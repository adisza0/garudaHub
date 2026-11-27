
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GarudaHub')</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
            color: #333;
        }

        nav {
            background: #173b65;
            padding: 16px 8%;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
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

        .btn-danger {
            background: #c0392b;
        }

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
        <a href="{{ route('projects.index') }}">Projects</a>
        <a href="{{ route('bids.index') }}">Bids</a>
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