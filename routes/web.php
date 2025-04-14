<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\TechnicianController;
use App\Http\Controllers\Admin\AssetController as AdminAssetController;
use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Technician\AssetController as TechnicianAssetController;
use App\Http\Controllers\Technician\ProfileController;
use Illuminate\Support\Facades\Route;

// All routes use web middleware group by default
Route::middleware('web')->group(function () {
    // Public routes
    Route::get('/', function () {
        return view('welcome');
    });

    // Guest routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login']);
    });

    // Auth routes
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        // Admin Routes
        Route::prefix('admin')
            ->name('admin.')
            ->middleware('admin')
            ->group(function () {
                Route::get('/dashboard', function () {
                    return view('admin.dashboard');
                })->name('dashboard');
                
                Route::resource('technicians', TechnicianController::class);
                Route::resource('assets', AdminAssetController::class);
                Route::resource('assignments', AssignmentController::class);
            });

        // Technician Routes
        Route::prefix('technician')
            ->name('technician.')
            ->middleware('technician')
            ->group(function () {
                Route::get('/dashboard', function () {
                    return view('technician.dashboard');
                })->name('dashboard');
                
                Route::resource('assets', TechnicianAssetController::class)->only(['index', 'show']);
                Route::put('assets/{asset}/mark-fixed', [TechnicianAssetController::class, 'markAsFixed'])->name('assets.mark-fixed');
                
                // Replace resource route with explicit routes
                Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
                Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
            });
    });
});
