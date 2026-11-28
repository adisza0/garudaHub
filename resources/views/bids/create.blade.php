@extends('layouts.app')

@section('title', 'Tambah Penawaran')

@section('content')
    <h1>Tambah Penawaran</h1>

    <form action="{{ route('bids.store') }}" method="POST">
        @csrf

        <label>Pilih Project</label>
        <select name="project_id" required>
            <option value="">-- Pilih Project --</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}"
                    {{ old('project_id') == $project->id ? 'selected' : '' }}>
                    {{ $project->judul }}
                    (Rp{{ number_format($project->budget_min) }} - Rp{{ number_format($project->budget_max) }})
                </option>
            @endforeach
        </select>
        @error('project_id')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>Harga Penawaran</label>
        <input type="number" name="harga" min="1" value="{{ old('harga') }}" required>
        @error('harga')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>Durasi Pengerjaan (hari)</label>
        <input type="number" name="durasi" min="1" value="{{ old('durasi') }}" required>
        @error('durasi')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>Proposal</label>
        <textarea name="proposal" required>{{ old('proposal') }}</textarea>
        @error('proposal')
            <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit" class="btn">Simpan Penawaran</button>
        <a href="{{ route('bids.index') }}" class="btn">Kembali</a>
    </form>
@endsection