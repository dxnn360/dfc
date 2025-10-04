<?php

namespace App\Http\Controllers;
use App\Models\Document;
use App\Models\LaporanPenyelidikan;
use App\Models\SuratPengantar;
use App\Models\SuratTugas;
use Illuminate\Http\Request;

class AnalisDashboardController extends Controller
{
    public function index(){
        $userId = auth()->id();

        $rejectedCount = Document::where('user_id', $userId)
            ->where('status', 'rejected')
            ->count();
        $prosesCount = Document::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();
        $completedCount = Document::where('user_id', $userId)
            ->where('status', 'approved')
            ->count();
        
        $suratTugas = SuratTugas::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();
        
        $suratPengantar = SuratPengantar::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();
        
        $laporan = LaporanPenyelidikan::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('analis.dashboard', compact('rejectedCount', 'prosesCount', 'completedCount', 'suratTugas', 'suratPengantar', 'laporan'));
    }
}
