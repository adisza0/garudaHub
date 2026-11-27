<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;

class BidController extends Controller
{
    // Menampilkan semua penawaran.
    public function index()
    {
        $bids = Bid::with(['project', 'developer'])
            ->latest('created_at')
            ->get();

        return view('bids.index', compact('bids'));
    }

    // Menampilkan formulir penawaran.
    public function create()
    {
        return view('bids.create');
    }

    // Menyimpan penawaran baru.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'developer_id' => 'required|exists:users,id',
            'harga' => 'required|integer|min:1',
            'durasi' => 'required|integer|min:1',
            'proposal' => 'required|string',
        ]);

        Bid::create($validated);

        return redirect()
            ->route('bids.index')
            ->with('success', 'Penawaran berhasil ditambahkan.');
    }

    // Menampilkan detail penawaran.
    public function show(Bid $bid)
    {
        $bid->load(['project', 'developer']);

        return view('bids.show', compact('bid'));
    }

    // Menampilkan formulir edit penawaran.
    public function edit(Bid $bid)
    {
        return view('bids.edit', compact('bid'));
    }

    // Memperbarui penawaran.
    public function update(Request $request, Bid $bid)
    {
        $validated = $request->validate([
            'harga' => 'required|integer|min:1',
            'durasi' => 'required|integer|min:1',
            'proposal' => 'required|string',
        ]);

        $bid->update($validated);

        return redirect()
            ->route('bids.index')
            ->with('success', 'Penawaran berhasil diperbarui.');
    }

    // Menghapus penawaran.
    public function destroy(Bid $bid)
    {
        $bid->delete();

        return redirect()
            ->route('bids.index')
            ->with('success', 'Penawaran berhasil dihapus.');
    }
}