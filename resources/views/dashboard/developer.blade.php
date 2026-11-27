
@extends('layouts.app')

@section('title', 'Dashboard Developer')

@section('content')
    <h1>Penawaran Saya</h1>

    @if ($bids->isEmpty())
        <p>Anda belum mengajukan penawaran.</p>
    @else
        @foreach ($bids as $bid)
            <div class="card">
                <h2>
                    <a href="{{ route('projects.show', $bid->project->id) }}">
                        {{ $bid->project->judul }}
                    </a>
                    - {{ ucfirst($bid->project->status) }}

                    @if ($bid->is_winner)
                        <strong> - Pemenang</strong>
                    @endif
                </h2>

                <p>
                    Klien: {{ $bid->project->client->nama }}
                    |
                    Harga: Rp{{ number_format($bid->harga) }}
                    |
                    Durasi: {{ $bid->durasi }} hari
                    |
                    Batas: {{ $bid->project->batas_lelang->format('d-m-Y') }}
                </p>
            </div>
        @endforeach
    @endif
@endsection
