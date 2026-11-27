
@extends('layouts.app')

@section('title', 'Daftar Projects')

@section('content')
    <h1>Daftar Projects</h1>

    <p>Daftar proyek yang tersedia di GarudaHub.</p>

    <a href="{{ route('projects.create') }}" class="btn">
        + Tambah Project
    </a>

    @if ($projects->isEmpty())
        <p>Belum ada data project.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Klien</th>
                    <th>Kategori</th>
                    <th>Budget</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->judul }}</td>
                        <td>{{ $project->client->nama }}</td>
                        <td>{{ $project->kategori }}</td>
                        <td>
                            Rp{{ number_format($project->budget_min) }}
                            - Rp{{ number_format($project->budget_max) }}
                        </td>
                        <td>{{ ucfirst($project->status) }}</td>
                        <td>
                            <a href="{{ route('projects.show', $project->id) }}">Detail</a>
                            |
                            <a href="{{ route('projects.edit', $project->id) }}">Edit</a>
                            |
                            <form action="{{ route('projects.destroy', $project->id) }}"
                                method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Yakin ingin menghapus project ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection