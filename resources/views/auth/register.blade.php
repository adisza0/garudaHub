@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Akun</h1>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div>
            <label>Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" maxlength="100" required>
            @error('nama')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" maxlength="100" required>
            @error('email')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" required>
            @error('password')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <div>
            <label>Daftar sebagai</label>
            <select name="role" required>
                <option value="klien">Klien</option>
                <option value="developer">Developer</option>
            </select>
        </div>

        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
</div>
@endsection