<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Bid;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'klien') {
            $projects = Project::withCount('bids')
                ->where('client_id', $user->id)
                ->latest('id')
                ->get();

            return view('dashboard.client', compact('projects'));
        }

        if ($user->role === 'developer') {
            $bids = Bid::with(['project.client'])
                ->where('developer_id', $user->id)
                ->latest('id')
                ->get();

            return view('dashboard.developer', compact('bids'));
        }

        abort(403, 'Dashboard tidak tersedia untuk peran ini.');
    }
}
