<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenyelidikan;
use App\Models\SuratPengantar;
use App\Models\SuratTugas;
use Illuminate\Http\Request;

class AnalisDocumentController extends Controller
{
    public function document(){
        // Counts
        $stProsesCount = SuratTugas::where('status', 'pending')->count();
        $stCompletedCount = SuratTugas::where('status', 'approved')->count();
        $stRejectedCount = SuratTugas::where('status', 'rejected')->count();

        $srProsesCount = SuratPengantar::where('status', 'pending')->count();
        $srCompletedCount = SuratPengantar::where('status', 'approved')->count();
        $srRejectedCount = SuratPengantar::where('status', 'rejected')->count();

        $lpProsesCount = LaporanPenyelidikan::where('status', 'pending')->count();
        $lpCompletedCount = LaporanPenyelidikan::where('status', 'approved')->count();
        $lpRejectedCount = LaporanPenyelidikan::where('status', 'rejected')->count();
        
        // Paginate **without calling get()**
        $suratTugas = SuratTugas::latest()->paginate(10);
        $suratPengantar = SuratPengantar::latest()->paginate(10);
        $laporan = LaporanPenyelidikan::latest()->paginate(10);

        return view('analis.document', compact(
            'suratTugas',
            'suratPengantar',
            'laporan', 
            'stProsesCount',
            'stCompletedCount',
            'stRejectedCount',
            'srProsesCount',
            'srCompletedCount',
            'srRejectedCount',
            'lpProsesCount',
            'lpCompletedCount',
            'lpRejectedCount' 
        ));
    }
}

