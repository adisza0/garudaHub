
@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')
    <h1>Edit Project</h1>

    <form action="{{ route('projects.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Judul Project</label>
        <input type="text" name="judul" value="{{ old('judul', $project->judul) }}" required>

        <label>Deskripsi</label>
        <textarea name="deskripsi" required>{{ old('deskripsi', $project->deskripsi) }}</textarea>

        <label>Kategori</label>
        <input type="text" name="kategori" value="{{ old('kategori', $project->kategori) }}" required>

        <label>Budget Minimum</label>
        <input type="number" name="budget_min" min="0" value="{{ old('budget_min', $project->budget_min) }}" required>

        <label>Budget Maksimum</label>
        <input type="number" name="budget_max" min="0" value="{{ old('budget_max', $project->budget_max) }}" required>

        <label>Batas Lelang</label>
        <input type="date" name="batas_lelang" value="{{ old('batas_lelang', $project->batas_lelang->format('Y-m-d')) }}" required>

        <label>Status</label>
        <select name="status" required>
            <option value="terbuka" {{ old('status', $project->status) == 'terbuka' ? 'selected' : '' }}>Terbuka</option>
            <option value="ditutup" {{ old('status', $project->status) == 'ditutup' ? 'selected' : '' }}>Ditutup</option>
        </select>

        <button type="submit" class="btn">Perbarui Project</button>
        <a href="{{ route('projects.index') }}" class="btn">Kembali</a>
    </form>
@endsection