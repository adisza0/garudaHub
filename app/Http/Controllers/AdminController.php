<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    // Menampilkan halaman admin.
    public function index()
    {
        $users = User::orderBy('id')->get();
        $projects = Project::with('client')
            ->latest('id')
            ->get();

        return view('admin.index', compact('users', 'projects'));
    }

    // Mengubah role pengguna.
    public function updateRole(Request $request, User $user)
    {
        abort_if($user->id === auth()->id(), 403, 'Anda tidak dapat mengubah peran sendiri.');

        $validated = $request->validate([
            'role' => ['required', Rule::in(['klien', 'developer', 'admin'])],
        ]);

        $user->update(['role' => $validated['role']]);

        return back()->with('success', 'Peran pengguna berhasil diubah.');
    }

    // Menghapus pengguna.
    public function destroyUser(User $user)
    {
        abort_if($user->id === auth()->id(), 403, 'Anda tidak dapat menghapus akun sendiri.');

        $user->delete();

        return back()->with('success', 'Pengguna dan data terkait berhasil dihapus.');
    }

    // Menghapus proyek.
    public function destroyProject(Project $project)
    {
        $project->delete();

        return back()->with('success', 'Proyek dan seluruh penawarannya berhasil dihapus.');
    }
}
