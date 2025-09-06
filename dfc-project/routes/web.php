<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard Admin
Route::middleware(['auth','role:admin'])
    ->get('/admin', [UserController::class, 'dashboard'])
    ->name('admin.dashboard');

Route::middleware(['auth','role:admin'])->get('/admin/template/surattugas', function () {
    return view('admin.template.surattugas');
})->name('admin.template.surattugas');

Route::middleware(['auth','role:admin'])->get('/admin/template/suratpengantar', function () {
    return view('admin.template.suratpengantar');
})->name('admin.template.suratpengantar');

Route::middleware(['auth','role:admin'])->get('/admin/template/laporan', function () {
    return view('admin.template.laporan');
})->name('admin.template.laporan');

Route::middleware(['auth','role:admin'])->group(function(){
    Route::resource('users', UserController::class);
});

// Dashboard Analis
Route::middleware(['auth','role:analis'])->get('/analis', function () {
    return view('analis.dashboard');
})->name('analis.dashboard');

Route::middleware(['auth','role:analis'])->get('/analis/dokumen',function(){
   return view('analis.document');
})->name('analis.document');

Route::middleware(['auth','role:analis'])->get('/analis/surat-tugas/baru',function(){
   return view('analis.surattugas.create');
})->name('analis.surat-tugas');

Route::middleware(['auth','role:analis'])->get('/analis/surat-pengantar/baru',function(){
   return view('analis.suratpengantar.create');
})->name('analis.surat-pengantar');

Route::middleware(['auth','role:analis'])->get('/analis/laporan/baru',function(){
   return view('analis.laporan.create');
})->name('analis.laporan');

// Dashboard Supervisor
Route::middleware(['auth','role:supervisor'])->get('/supervisor', function () {
    return view('supervisor.dashboard');
})->name('supervisor.dashboard');

Route::middleware(['auth','role:supervisor'])->get('/supervisor/dokumen',function(){
   return view('supervisor.document');
})->name('supervisor.document');

Route::middleware(['auth','role:supervisor'])->get('/supervisor/st/approval',function(){
   return view('supervisor.surattugas');
})->name('supervisor.surattugas');

Route::middleware(['auth','role:supervisor'])->get('/supervisor/sp/approval',function(){
   return view('supervisor.suratpengantar');
})->name('supervisor.suratpengantar');

Route::middleware(['auth','role:supervisor'])->get('/supervisor/lp/approval',function(){
   return view('supervisor.laporan');
})->name('supervisor.laporan');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
