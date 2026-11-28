<?php

// NIM: 252410102039
// Tugas 2 - The Phantom Vulnerability

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Registrasi dan login
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Route untuk pengguna yang sudah login
Route::middleware('auth')->group(function () {

    // Daftar proyek
    Route::get('/projects', [ProjectController::class, 'index'])
        ->name('projects.index');

    // Pengelolaan proyek dan pemilihan pemenang oleh klien
    Route::middleware('role:klien')->group(function () {
        Route::get('/projects/create', [ProjectController::class, 'create'])
            ->name('projects.create');

        Route::post('/projects', [ProjectController::class, 'store'])
            ->name('projects.store');

        Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])
            ->name('projects.edit');

        Route::put('/projects/{project}', [ProjectController::class, 'update'])
            ->name('projects.update');

        Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])
            ->name('projects.destroy');

        Route::post('/projects/{project}/bids/{bid}/pick', [BidController::class, 'pick'])
            ->name('bids.pick');
    });

    // Pengelolaan bid oleh developer
    Route::middleware('role:developer')->group(function () {
        Route::resource('bids', BidController::class);
    });

    // Pengelolaan admin
    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::patch('/users/{user}/role', [AdminController::class, 'updateRole'])->name('users.role');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::delete('/projects/{project}', [AdminController::class, 'destroyProject'])->name('projects.destroy');
    });

    // Detail proyek
    Route::get('/projects/{project}', [ProjectController::class, 'show'])
        ->name('projects.show');
});
