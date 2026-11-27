<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Menampilkan semua project.
    public function index()
    {
        $projects = Project::with('client')
            ->latest('created_at')
            ->get();

        return view('projects.index', compact('projects'));
    }

    // Menampilkan formulir tambah project.
    public function create()
    {
        return view('projects.create');
    }

    // Menyimpan project baru.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string|max:50',
            'budget_min' => 'required|integer|min:0',
            'budget_max' => 'required|integer|gte:budget_min',
            'batas_lelang' => 'required|date',
            'status' => 'required|in:terbuka,ditutup',
        ]);

        $request->user()->projects()->create($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    // Menampilkan detail project.
    public function show(Project $project)
    {
        $project->load(['client', 'bids.developer']);

        return view('projects.show', compact('project'));
    }

    // Memeriksa kepemilikan project.
    private function authorizeOwner(Project $project): void
    {
        abort_unless(
            $project->client_id === auth()->id(),
            403,
            'Anda tidak memiliki hak untuk mengelola project ini.'
        );
    }

    // Menampilkan formulir edit project.
    public function edit(Project $project)
    {
        $this->authorizeOwner($project);

        return view('projects.edit', compact('project'));
    }

    // Memperbarui project.
    public function update(Request $request, Project $project)
    {
        $this->authorizeOwner($project);

        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string|max:50',
            'budget_min' => 'required|integer|min:0',
            'budget_max' => 'required|integer|gte:budget_min',
            'batas_lelang' => 'required|date',
            'status' => 'required|in:terbuka,ditutup',
        ]);

        $project->update($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project berhasil diperbarui.');
    }

    // Menghapus project.
    public function destroy(Project $project)
    {
        $this->authorizeOwner($project);

        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }
}
