<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\TemplateController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard Admin
Route::middleware(['auth','role:admin'])
    ->get('/admin', [UserController::class, 'dashboard'])
    ->name('admin.dashboard');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/templates', [TemplateController::class, 'index'])->name('templates.index');
    Route::get('/templates/{type}/edit', [TemplateController::class, 'edit'])->name('templates.edit');
    Route::post('/templates/{type}', [TemplateController::class, 'update'])->name('templates.update');
});


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

Route::middleware(['auth','role:analis'])->get('/analis/surat-tugas/edit',function(){
   return view('analis.surattugas.edit');
})->name('analis.surattugas.edit');

Route::middleware(['auth','role:analis'])->get('/analis/surat-pengantar/baru',function(){
   return view('analis.suratpengantar.create');
})->name('analis.surat-pengantar');

Route::middleware(['auth','role:analis'])->get('/analis/surat-pengantar/edit',function(){
   return view('analis.suratpengantar.edit');
})->name('analis.suratpengantar.edit');

Route::middleware(['auth','role:analis'])->get('/analis/laporan/baru',function(){
   return view('analis.laporan.create');
})->name('analis.laporan');

Route::middleware(['auth','role:analis'])->get('/analis/laporan/edit',function(){
   return view('analis.laporan.edit');
})->name('analis.laporan.edit');

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
    $user = Auth::user();

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('analis')) {
        return redirect()->route('analis.dashboard');
    } elseif ($user->hasRole('supervisor')) {
        return redirect()->route('supervisor.dashboard');
    }

    abort(403, 'Unauthorized');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
