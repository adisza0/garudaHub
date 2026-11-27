
@extends('layouts.app')

@section('title', 'Edit Penawaran')

@section('content')
    <h1>Edit Penawaran</h1>

    <form action="{{ route('bids.update', $bid->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Harga Penawaran</label>
        <input
            type="number"
            name="harga"
            min="1"
            value="{{ old('harga', $bid->harga) }}"
            required
        >
        @error('harga')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>Durasi Pengerjaan (hari)</label>
        <input
            type="number"
            name="durasi"
            min="1"
            value="{{ old('durasi', $bid->durasi) }}"
            required
        >
        @error('durasi')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>Proposal</label>
        <textarea name="proposal" required>{{ old('proposal', $bid->proposal) }}</textarea>
        @error('proposal')
            <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit" class="btn">Perbarui Penawaran</button>
        <a href="{{ route('bids.index') }}" class="btn">Kembali</a>
    </form>
@endsection
