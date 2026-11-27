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
            'client_id' => 'required|exists:users,id',
            'judul' => 'required|string|max:200',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string|max:50',
            'budget_min' => 'required|integer|min:0',
            'budget_max' => 'required|integer|gte:budget_min',
            'batas_lelang' => 'required|date',
            'status' => 'required|in:terbuka,ditutup',
        ]);

        Project::create($validated);

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

    // Menampilkan formulir edit project.
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    // Memperbarui project.
    public function update(Request $request, Project $project)
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

        $project->update($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project berhasil diperbarui.');
    }

    // Menghapus project.
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }
}