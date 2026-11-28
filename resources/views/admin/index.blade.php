
@extends('layouts.app')

@section('title', 'Admin GarudaHub')

@section('content')
<h1>Panel Administrator</h1>

@if (session('success'))
    <p class="text-success">{{ session('success') }}</p>
@endif

<h2>Daftar Pengguna</h2>
<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.role', $user) }}">
                            @csrf
                            @method('PATCH')
                            <select name="role">
                                @foreach (['klien', 'developer', 'admin'] as $role)
                                    <option value="{{ $role }}" @selected($user->role === $role)>
                                        {{ ucfirst($role) }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit">Ubah</button>
                        </form>
                    @else
                        {{ ucfirst($user->role) }} (Anda)
                    @endif
                </td>
                <td>
                    @if ($user->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                              onsubmit="return confirm('Hapus pengguna ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Daftar Proyek</h2>
<table>
    <thead>
        <tr>
            <th>Judul</th>
            <th>Pemilik</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
            <tr>
                <td>{{ $project->judul }}</td>
                <td>{{ $project->client->nama }}</td>
                <td>{{ ucfirst($project->status) }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.projects.destroy', $project) }}"
                          onsubmit="return confirm('Hapus proyek ini beserta penawarannya?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
