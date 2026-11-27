@extends('layouts.app')

@section('title', 'Tambah Project')

@section('content')
    <h1>Tambah Project</h1>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf

        <label>Judul Project</label>
        <input type="text" name="judul" value="{{ old('judul') }}" maxlength="200" required>
        @error('judul')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>Deskripsi</label>
        <textarea name="deskripsi" required>{{ old('deskripsi') }}</textarea>
        @error('deskripsi')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>Kategori</label>
        <input type="text" name="kategori" value="{{ old('kategori') }}" maxlength="50" required>
        @error('kategori')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>Budget Minimum</label>
        <input type="number" name="budget_min" min="0" value="{{ old('budget_min', 0) }}" required>
        @error('budget_min')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>Budget Maksimum</label>
        <input type="number" name="budget_max" min="0" value="{{ old('budget_max') }}" required>
        @error('budget_max')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>Batas Lelang</label>
        <input type="date" name="batas_lelang" value="{{ old('batas_lelang') }}" required>
        @error('batas_lelang')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>Status</label>
        <select name="status" required>
            <option value="terbuka" {{ old('status', 'terbuka') === 'terbuka' ? 'selected' : '' }}>Terbuka</option>
            <option value="ditutup" {{ old('status') === 'ditutup' ? 'selected' : '' }}>Ditutup</option>
        </select>
        @error('status')
            <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit" class="btn">Simpan Project</button>
        <a href="{{ route('projects.index') }}" class="btn">Kembali</a>
    </form>
@endsection
