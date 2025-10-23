<?php

use App\Http\Controllers\AnalisDocumentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Analis\SuratTugasController;
use App\Http\Controllers\AnalisDashboardController;
use App\Http\Controllers\SuratPengantarController;
use App\Http\Controllers\LaporanPenyelidikanController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard Admin
Route::middleware(['auth', 'role:admin'])
    ->get('/admin', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/templates', [TemplateController::class, 'index'])->name('templates.index');
    Route::get('/templates/{type}/edit', [TemplateController::class, 'edit'])->name('templates.edit');
    Route::post('/templates/{type}', [TemplateController::class, 'update'])->name('templates.update');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

// Dashboard Analis
Route::middleware(['auth', 'role:analis'])->prefix('analis')->name('analis.')->group(function () {
    Route::get('/', [AnalisDashboardController::class, 'index'])->name('dashboard');
});

Route::prefix('analis')->middleware(['auth','role:analis'])->group(function () {
    Route::get('/dokumen', [AnalisDocumentController::class, 'document'])->name('analis.document');
});

Route::prefix('analis')->name('analis.')->group(function () {
    Route::resource('surat_tugas', SuratTugasController::class)->parameters(['surat_tugas' => 'surat_tugas']);
    Route::get('surat_tugas/{surat_tugas}/download', [SuratTugasController::class, 'download'])->name('surat_tugas.download');
    Route::get('surat_tugas/{surat_tugas}/preview-html', [SuratTugasController::class, 'preview'])->name('analis.surat_tugas.preview');

});

Route::prefix('analis')->name('analis.')->group(function () {
    Route::resource('surat_pengantar', SuratPengantarController::class);
    Route::get('surat_pengantar/{surat_pengantar}/download', [SuratPengantarController::class, 'download'])
        ->name('surat_pengantar.download');
});

Route::prefix('analis')->name('analis.')->group(function () {
    Route::resource('laporan', LaporanPenyelidikanController::class);
    Route::get('laporan/{laporan}/download', [LaporanPenyelidikanController::class, 'downloadFullReport'])->name('laporan.download');
    Route::post('laporan/upload-image', [LaporanPenyelidikanController::class, 'uploadImage'])->name('laporan.upload-image');
});

// Dashboard supervisor
Route::prefix('supervisor')->middleware(['auth', 'role:supervisor'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [SupervisorController::class, 'dashboard'])->name('supervisor.dashboard');

    // Surat Tugas
    Route::get('surat-tugas/{id}/detail', [SupervisorController::class, 'detailSuratTugas'])->name('supervisor.surat-tugas.detail');
    Route::get('surat-tugas/{id}/pdf', [SupervisorController::class, 'previewPdfSuratTugas'])->name('supervisor.surat-tugas.pdf');
    Route::post('surat-tugas/{id}/approve', [SupervisorController::class, 'approveSuratTugas'])->name('supervisor.surat-tugas.approve');
    Route::post('surat-tugas/{id}/reject', [SupervisorController::class, 'rejectSuratTugas'])->name('supervisor.surat-tugas.reject');

    // Surat Pengantar
    Route::get('surat-pengantar/{id}/detail', [SupervisorController::class, 'detailSuratPengantar'])->name('supervisor.surat-pengantar.detail');
    Route::get('surat-pengantar/{id}/pdf', [SupervisorController::class, 'previewPdfSuratPengantar'])->name('supervisor.surat-pengantar.pdf');
    Route::post('surat-pengantar/{id}/approve', [SupervisorController::class, 'approveSuratPengantar'])->name('supervisor.surat-pengantar.approve');
    Route::post('surat-pengantar/{id}/reject', [SupervisorController::class, 'rejectSuratPengantar'])->name('supervisor.surat-pengantar.reject');

    // Laporan Penyelidikan
    Route::get('laporan/{id}/detail', [SupervisorController::class, 'detailLaporan'])->name('supervisor.laporan.detail');
    Route::get('laporan/{id}/pdf', [SupervisorController::class, 'previewPdfLaporan'])->name('supervisor.laporan.pdf');
    Route::post('laporan/{id}/approve', [SupervisorController::class, 'approveLaporan'])->name('supervisor.laporan.approve');
    Route::post('laporan/{id}/reject', [SupervisorController::class, 'rejectLaporan'])->name('supervisor.laporan.reject');
});

Route::prefix('supervisor')->middleware(['auth','role:supervisor'])->group(function () {
    Route::get('/documents', [DocumentController::class, 'index'])->name('supervisor.document');
});


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

require __DIR__ . '/auth.php';
