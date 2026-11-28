@extends('layouts.app')

@section('title', 'Detail Project')

@section('content')
    <h1>{{ $project->judul }}</h1>

    <p><strong>Klien:</strong> {{ $project->client->nama }}</p>
    <p><strong>Kategori:</strong> {{ $project->kategori }}</p>
    <p><strong>Deskripsi:</strong> {{ $project->deskripsi }}</p>

    <p>
        <strong>Budget:</strong>
        Rp{{ number_format($project->budget_min) }}
        - Rp{{ number_format($project->budget_max) }}
    </p>

    <p><strong>Batas Lelang:</strong> {{ $project->batas_lelang->format('d-m-Y') }}</p>
    <p><strong>Status:</strong> {{ ucfirst($project->status) }}</p>

    <hr>

    <h2>Daftar Penawaran</h2>

    @if ($project->bids->isEmpty())
        <p>Belum ada penawaran untuk project ini.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Developer</th>
                    <th>Harga</th>
                    <th>Durasi</th>
                    <th>Proposal</th>
                    <th>Status</th>
                    @if (auth()->id() === $project->client_id && $project->status === 'terbuka')
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($project->bids as $bid)
                    <tr>
                        <td>{{ $bid->developer->nama }}</td>
                        <td>Rp{{ number_format($bid->harga) }}</td>
                        <td>{{ $bid->durasi }} hari</td>
                        <td>{{ $bid->proposal }}</td>
                        <td>
                            @if ($bid->is_winner)
                                <strong>Pemenang</strong>
                            @else
                                Menunggu
                            @endif
                        </td>

                        @if (auth()->id() === $project->client_id && $project->status === 'terbuka')
                            <td>
                                <form action="{{ route('bids.pick', [$project->id, $bid->id]) }}"
                                      method="POST"
                                      onsubmit="return confirm('Pilih developer ini sebagai pemenang?')">
                                    @csrf
                                    <button type="submit">Pilih Pemenang</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <br>

    <a href="{{ route('projects.index') }}" class="btn">Kembali</a>

    @if (auth()->id() === $project->client_id)
        <a href="{{ route('projects.edit', $project->id) }}" class="btn">Edit Project</a>
    @endif
@endsection