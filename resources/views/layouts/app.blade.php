
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GarudaHub')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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

            <span class="nav-user">
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