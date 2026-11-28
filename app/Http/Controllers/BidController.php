<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $projects = Project::where('status', 'terbuka')
            ->latest('created_at')
            ->get();

        return view('bids.create', compact('projects'));
    }

    // Menyimpan penawaran baru.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'harga' => 'required|integer|min:1',
            'durasi' => 'required|integer|min:1',
            'proposal' => 'required|string',
        ]);

        $project = Project::findOrFail($validated['project_id']);

        if ($project->status !== 'terbuka') {
            return back()
                ->withErrors(['project_id' => 'Project sudah ditutup.'])
                ->withInput();
        }

        $request->user()->bids()->create([
            'project_id' => $project->id,
            'harga' => $validated['harga'],
            'durasi' => $validated['durasi'],
            'proposal' => $validated['proposal'],
        ]);

        return redirect()
            ->route('bids.index')
            ->with('success', 'Penawaran berhasil ditambahkan.');
    }

    // Memeriksa kepemilikan bid.
    private function authorizeOwner(Bid $bid): void
    {
        abort_unless(
            $bid->developer_id === auth()->id(),
            403,
            'Anda tidak memiliki hak untuk mengelola penawaran ini.'
        );
    }

    // Memilih developer sebagai pemenang proyek.
    public function pick(Project $project, Bid $bid)
    {
        DB::transaction(function () use ($project, $bid) {
            $lockedProject = Project::whereKey($project->id)
                ->lockForUpdate()
                ->firstOrFail();

            abort_unless(
                $lockedProject->client_id === auth()->id(),
                403,
                'Anda bukan pemilik proyek ini.'
            );

            abort_unless(
                $lockedProject->status === 'terbuka',
                422,
                'Proyek sudah ditutup atau pemenang sudah dipilih.'
            );

            $selectedBid = Bid::whereKey($bid->id)
                ->where('project_id', $lockedProject->id)
                ->firstOrFail();

            // Pastikan hanya satu penawaran yang menjadi pemenang.
            Bid::where('project_id', $lockedProject->id)
                ->update(['is_winner' => false]);

            $selectedBid->update(['is_winner' => true]);

            // Tutup proyek setelah pemenang dipilih.
            $lockedProject->update(['status' => 'ditutup']);
        });

        return redirect()
            ->route('projects.show', $project->id)
            ->with('success', 'Pemenang proyek berhasil dipilih.');
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
        $this->authorizeOwner($bid);

        return view('bids.edit', compact('bid'));
    }

    // Memperbarui penawaran.
    public function update(Request $request, Bid $bid)
    {
        $this->authorizeOwner($bid);

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
        $this->authorizeOwner($bid);

        $bid->delete();

        return redirect()
            ->route('bids.index')
            ->with('success', 'Penawaran berhasil dihapus.');
    }
}