<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard Admin
Route::middleware(['auth','role:admin'])->get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::middleware(['auth','role:admin'])->group(function(){
    Route::resource('users', UserController::class);
});

// Dashboard Analis
Route::middleware(['auth','role:analis'])->get('/analis', function () {
    return view('analis.dashboard');
})->name('analis.dashboard');

// Dashboard Supervisor
Route::middleware(['auth','role:supervisor'])->get('/supervisor', function () {
    return view('supervisor.dashboard');
})->name('supervisor.dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
