@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Masuk</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">Masuk</button>
    </form>

    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
</div>
@endsection