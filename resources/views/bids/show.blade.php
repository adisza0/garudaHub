
@extends('layouts.app')

@section('title', 'Detail Penawaran')

@section('content')
    <h1>Detail Penawaran</h1>

    <p><strong>Project:</strong> {{ $bid->project->judul }}</p>
    <p><strong>Developer:</strong> {{ $bid->developer->nama }}</p>
    <p><strong>Harga:</strong> Rp{{ number_format($bid->harga) }}</p>
    <p><strong>Durasi:</strong> {{ $bid->durasi }} hari</p>
    <p><strong>Proposal:</strong> {{ $bid->proposal }}</p>
    <p><strong>Status Pemenang:</strong> {{ $bid->is_winner ? 'Ya' : 'Tidak' }}</p>

    <br>

    <a href="{{ route('bids.index') }}" class="btn">Kembali</a>
    <a href="{{ route('bids.edit', $bid->id) }}" class="btn">Edit Penawaran</a>
@endsection