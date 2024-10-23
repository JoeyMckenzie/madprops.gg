<?php

declare(strict_types=1);

use App\Http\Controllers\ProfileAvatarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileSocialsController;
use App\Http\MadPropController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => Inertia::render('landing/Index'))->name('home');

Route::get('/@{username}', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/socials', [ProfileSocialsController::class, 'update'])->name('profile.socials.update');
    Route::post('/profile/avatar', [ProfileAvatarController::class, 'update'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/@{username}/mad-props', [MadPropController::class, 'create'])->name('mad-props.create');
    Route::post('/@{username}/mad-props', [MadPropController::class, 'store'])->name('mad-props.store');
});

require __DIR__.'/auth.php';
