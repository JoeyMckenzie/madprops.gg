<?php

declare(strict_types=1);

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileDisplaySocialsController;
use App\Http\Controllers\ProfileSocialsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/@{username}', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/socials/display', [ProfileDisplaySocialsController::class, 'update'])->name('profile.socials.display.update');
    Route::patch('/profile/socials', [ProfileSocialsController::class, 'update'])->name('profile.socials.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
