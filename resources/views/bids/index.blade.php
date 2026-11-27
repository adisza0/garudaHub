@extends('layouts.app')

@section('title', 'Daftar Bids')

@section('content')
    <h1>Daftar Penawaran</h1>

    <p>Daftar penawaran developer untuk proyek GarudaHub.</p>

    <a href="{{ route('bids.create') }}" class="btn">
        + Tambah Penawaran
    </a>

    @if ($bids->isEmpty())
        <p>Belum ada data penawaran.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Project</th>
                    <th>Developer</th>
                    <th>Harga</th>
                    <th>Durasi</th>
                    <th>Pemenang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bids as $bid)
                    <tr>
                        <td>{{ $bid->project->judul }}</td>
                        <td>{{ $bid->developer->nama }}</td>
                        <td>Rp{{ number_format($bid->harga) }}</td>
                        <td>{{ $bid->durasi }} hari</td>
                        <td>{{ $bid->is_winner ? 'Ya' : 'Tidak' }}</td>
                        <td>
                            <a href="{{ route('bids.show', $bid->id) }}">Detail</a>

                            @if (auth()->id() === $bid->developer_id)
                                |
                                <a href="{{ route('bids.edit', $bid->id) }}">Edit</a>

                                <form action="{{ route('bids.destroy', $bid->id) }}"
                                    method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('Yakin ingin menghapus penawaran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
