
@extends('layouts.app')

@section('title', 'Tambah Project')

@section('content')
    <h1>Tambah Project</h1>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf

        <label>ID Klien</label>
        <input type="number" name="client_id" value="{{ old('client_id') }}" required>
        @error('client_id')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>Judul Project</label>
        <input type="text" name="judul" value="{{ old('judul') }}" required>
        @error('judul')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>Deskripsi</label>
        <textarea name="deskripsi" required>{{ old('deskripsi') }}</textarea>
        @error('deskripsi')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>Kategori</label>
        <input type="text" name="kategori" value="{{ old('kategori') }}" required>

        <label>Budget Minimum</label>
        <input type="number" name="budget_min" min="0" value="{{ old('budget_min', 0) }}" required>

        <label>Budget Maksimum</label>
        <input type="number" name="budget_max" min="0" value="{{ old('budget_max') }}" required>

        <label>Batas Lelang</label>
        <input type="date" name="batas_lelang" value="{{ old('batas_lelang') }}" required>

        <label>Status</label>
        <select name="status" required>
            <option value="terbuka">Terbuka</option>
            <option value="ditutup">Ditutup</option>
        </select>

        <button type="submit" class="btn">Simpan Project</button>
        <a href="{{ route('projects.index') }}" class="btn">Kembali</a>
    </form>
@endsection