@extends('layouts.app')

@section('title', 'Dashboard Klien')

@section('content')
    <h1>Proyek Saya</h1>

    <p>
        <a href="{{ route('projects.create') }}" class="btn">
            Pasang Proyek Baru
        </a>
    </p>

    @if ($projects->isEmpty())
        <p>Anda belum memasang proyek.</p>
    @else
        @foreach ($projects as $project)
            <div class="card">
                <h2>
                    <a href="{{ route('projects.show', $project->id) }}">
                        {{ $project->judul }}
                    </a>
                    - {{ ucfirst($project->status) }}
                </h2>

                <p>
                    Budget:
                    Rp{{ number_format($project->budget_min) }}
                    -
                    Rp{{ number_format($project->budget_max) }}
                    |
                    Batas: {{ $project->batas_lelang->format('d-m-Y') }}
                    |
                    {{ $project->bids_count }} penawaran
                </p>
            </div>
        @endforeach
    @endif
@endsection
