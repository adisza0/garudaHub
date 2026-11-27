<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Bid;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Data Users
        User::factory()->create([
            'nama' => 'Administrator',
            'email' => 'admin@garudahub.test',
            'role' => 'admin',
        ]);

        $klien = User::factory()->create([
            'nama' => 'Klien Demo',
            'email' => 'klien@garudahub.test',
            'role' => 'klien',
        ]);

        $developer = User::factory()->create([
            'nama' => 'Developer Demo',
            'email' => 'developer@garudahub.test',
            'role' => 'developer',
        ]);

        // Data Projects
        $project = Project::create([
            'client_id' => $klien->id,
            'judul' => 'Pembuatan Website GarudaHub',
            'deskripsi' => 'Pembuatan website marketplace jasa pengembangan perangkat lunak.',
            'kategori' => 'Web Development',
            'budget_min' => 3000000,
            'budget_max' => 5000000,
            'batas_lelang' => now()->addDays(14)->toDateString(),
            'status' => 'terbuka',
        ]);

        // Data Bids
        Bid::create([
            'project_id' => $project->id,
            'developer_id' => $developer->id,
            'harga' => 4000000,
            'durasi' => 30,
            'proposal' => 'Saya siap mengembangkan website sesuai kebutuhan proyek.',
            'is_winner' => false,
        ]);
    }
}