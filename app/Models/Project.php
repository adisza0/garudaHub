<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'client_id',
        'judul',
        'deskripsi',
        'kategori',
        'budget_min',
        'budget_max',
        'batas_lelang',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'budget_min' => 'integer',
            'budget_max' => 'integer',
            'batas_lelang' => 'date',
        ];
    }

    // Project dimiliki oleh satu klien.
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    // Project dapat memiliki banyak penawaran.
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class, 'project_id');
    }
}