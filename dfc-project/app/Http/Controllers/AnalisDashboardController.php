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
        
        $STrejectedCount = SuratTugas::where('user_id', $userId)
            ->where('status', 'rejected')
            ->count();
        $STprosesCount = SuratTugas::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();
        $STcompletedCount = SuratTugas::where('user_id', $userId)
            ->where('status', 'approved')
            ->count();
        
        $SPrejectedCount = SuratPengantar::where('user_id', $userId)
            ->where('status', 'rejected')
            ->count();
        $SPprosesCount = SuratPengantar::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();
        $SPcompletedCount = SuratPengantar::where('user_id', $userId)
            ->where('status', 'approved')
            ->count();
        
        $LPrejectedCount = LaporanPenyelidikan::where('user_id', $userId)
            ->where('status', 'rejected')
            ->count();
        $LPprosesCount = LaporanPenyelidikan::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();
        $LPcompletedCount = LaporanPenyelidikan::where('user_id', $userId)
            ->where('status', 'approved')
            ->count();

        $rejectedCount = $STrejectedCount + $SPrejectedCount + $LPrejectedCount;
        $prosesCount = $STprosesCount + $SPprosesCount + $LPprosesCount;
        $completedCount = $STcompletedCount + $SPcompletedCount + $LPcompletedCount;
        
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
