<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', \App\Http\Livewire\ShowThreads::class)
    ->middleware(['auth'])
    ->name('forum');

Route::get('/thread/{thread}', \App\Http\Livewire\ShowThread::class)
    ->middleware(['auth'])
    ->name('thread');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/landingpage',[\App\Http\Controllers\Landingpage::class, 'show']);

require __DIR__.'/auth.php';