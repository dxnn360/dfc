<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LaporanPenyelidikan;
use App\Models\SuratTugas;
use App\Models\SuratPengantar;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $suratTugas = SuratTugas::latest()->get();
        $suratPengantar = SuratPengantar::latest()->get();
        $laporan = LaporanPenyelidikan::latest()->get();

        return view('supervisor.document', compact(
            'suratTugas',
            'suratPengantar',
            'laporan'
        ));
    }
}
