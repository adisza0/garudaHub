<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['nama', 'email', 'password', 'role'])]
#[Hidden(['password'])]
class User extends Authenticatable
{
    public $timestamps = false;
    
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Satu klien dapat memiliki banyak project.
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'client_id');
    }

    // Satu developer dapat memiliki banyak bid.
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class, 'developer_id');
    }
}