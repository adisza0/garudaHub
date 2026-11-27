
@extends('layouts.app')

@section('title', 'Tambah Penawaran')

@section('content')
    <h1>Tambah Penawaran</h1>

    <form action="{{ route('bids.store') }}" method="POST">
        @csrf

        <label>ID Project</label>
        <input type="number" name="project_id" value="{{ old('project_id') }}" required>
        @error('project_id')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>ID Developer</label>
        <input type="number" name="developer_id" value="{{ old('developer_id') }}" required>
        @error('developer_id')
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
