<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratTugas;
use App\Models\SuratPengantar;
use App\Models\LaporanPenyelidikan;
use App\Models\DocumentTemplate;
use Barryvdh\DomPDF\Facade\Pdf;

class SupervisorController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $suratTugas = SuratTugas::whereIn('status', ['pending', 'approved', 'rejected'])->get();
        $suratPengantar = SuratPengantar::whereIn('status', ['pending', 'approved', 'rejected'])->get();
        $laporan = LaporanPenyelidikan::whereIn('status', ['pending', 'approved', 'rejected'])->get();

        return view('supervisor.dashboard', compact('suratTugas', 'suratPengantar', 'laporan'));
    }

    // ------------------ Detail Pages ------------------
    public function detailSuratTugas($id)
    {
        $surat = SuratTugas::findOrFail($id);
        return view('supervisor.surat-tugas.detail', compact('surat'));
    }

    public function detailSuratPengantar($id)
    {
        $surat = SuratPengantar::findOrFail($id);
        return view('supervisor.surat-pengantar.detail', compact('surat'));
    }

    public function detailLaporan($id)
    {
        $laporan = LaporanPenyelidikan::findOrFail($id);
        return view('supervisor.laporan.detail', compact('laporan'));
    }

    // ------------------ PDF Preview ------------------
    public function previewPdfSuratTugas($id)
    {
        $surat = SuratTugas::findOrFail($id);
        $template = DocumentTemplate::where('type', 'surat_tugas')->first();

        $header = $template?->header ?? '';
        $body = $template?->body ?? '';
        $footer = $template?->footer ?? '';

        // Daftar ahli
        $daftarAhli = '';
        if ($surat->users) {
            $daftarAhli = "<ul>";
            foreach ($surat->users as $user) {
                $daftarAhli .= "<li>" . e($user->name) . "</li>";
            }
            $daftarAhli .= "</ul>";
        }

        $data = [
            'nomor_surat' => $surat->nomor_surat,
            'tanggal' => \Carbon\Carbon::parse($surat->tanggal)->translatedFormat('d F Y'),
            'sumber' => $surat->sumber_permintaan,
            'ringkasan' => $surat->ringkasan_kasus,
            'daftar_ahli' => $daftarAhli,
        ];

        foreach ($data as $key => $val) {
            $regexCurly = "/{{\s*$key\s*}}/i";
            $regexBracket = "/\[$key\]/i";

            $header = preg_replace($regexCurly, $val, $header);
            $header = preg_replace($regexBracket, $val, $header);

            $body = preg_replace($regexCurly, $val, $body);
            $body = preg_replace($regexBracket, $val, $body);

            $footer = preg_replace($regexCurly, $val, $footer);
            $footer = preg_replace($regexBracket, $val, $footer);
        }

        $pdf = Pdf::loadView('supervisor.surat-tugas.pdf', compact('header', 'body', 'footer'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("Surat_Tugas_{$surat->tanggal}.pdf");
    }

    // ------------------ PDF Preview Surat Pengantar ------------------
    public function previewPdfSuratPengantar($id)
    {
        $surat = SuratPengantar::findOrFail($id);
        $template = DocumentTemplate::where('type', 'surat_pengantar')->first();

        $header = $template?->header ?? '';
        $body = $template?->body ?? '';
        $footer = $template?->footer ?? '';

        $barangBuktiList = '';
        if ($surat->barang_bukti) {
            $items = is_string($surat->barang_bukti) ? json_decode($surat->barang_bukti, true) : $surat->barang_bukti;
            $barangBuktiList = "<ul>";
            foreach ($items as $bb) {
                $barangBuktiList .= "<li>" . e($bb) . "</li>";
            }
            $barangBuktiList .= "</ul>";
        }

        $data = [
            'nomor_surat' => $surat->nomor_surat,
            'tanggal' => \Carbon\Carbon::parse($surat->tanggal)->translatedFormat('d F Y'),
            'nama_pemohon' => $surat->nama_pemohon,
            'jabatan_pemohon' => $surat->jabatan_pemohon,
            'klasifikasi' => $surat->klasifikasi,
            'barang_bukti' => $barangBuktiList,
        ];

        foreach ($data as $key => $val) {
            $regexCurly = "/{{\s*$key\s*}}/i";
            $regexBracket = "/\[$key\]/i";

            $header = preg_replace($regexCurly, $val, $header);
            $header = preg_replace($regexBracket, $val, $header);

            $body = preg_replace($regexCurly, $val, $body);
            $body = preg_replace($regexBracket, $val, $body);

            $footer = preg_replace($regexCurly, $val, $footer);
            $footer = preg_replace($regexBracket, $val, $footer);
        }

        $pdf = Pdf::loadView('supervisor.surat-pengantar.pdf', compact('header', 'body', 'footer'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("Surat_Pengantar_{$surat->tanggal}.pdf");
    }

    // ------------------ PDF Preview Laporan ------------------
    public function previewPdfLaporan($id)
    {
        $laporan = LaporanPenyelidikan::findOrFail($id);
        $template = DocumentTemplate::where('type', 'laporan_penyelidikan')->first();

        $header = $template?->header ?? '';
        $body = $template?->body ?? '';
        $footer = $template?->footer ?? '';

        // Fungsi untuk convert string/JSON/array ke <ul><li>…</li></ul>
        $toHtmlList = function ($field) use (&$toHtmlList) {
            if (!$field)
                return '';

            // If it's not an array, try to decode JSON; if not JSON, treat as scalar string
            if (!is_array($field)) {
                $decoded = json_decode($field, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $field = $decoded;
                } else {
                    return e((string) $field); // jika string biasa
                }
            }

            // Now $field is an array; build nested <ul> safely
            $html = '<ul>';
            foreach ($field as $item) {
                if (is_array($item)) {
                    $html .= '<li>' . $toHtmlList($item) . '</li>';
                } else {
                    $html .= '<li>' . e((string) $item) . '</li>';
                }
            }
            $html .= '</ul>';
            return $html;
        };

        $data = [
            'nomor_surat' => e($laporan->nomor_surat),
            'info' => e($laporan->informasi_pemeriksaan),
            'tanggal' => \Carbon\Carbon::parse($laporan->tanggal)->translatedFormat('d F Y'),
            'nama_pemohon' => e($laporan->nama_pemohon),
            'jabatan_pemohon' => e($laporan->jabatan_pemohon),
            'barang_bukti' => $toHtmlList($laporan->barang_bukti),
            'tujuan' => e($laporan->tujuan_pemeriksaan),
            'metodologi' => e($laporan->metodologi),
            'sumber' => $toHtmlList($laporan->sumber),
            'hasil' => e($laporan->hasil_pemeriksaan),
            'kesimpulan' => e($laporan->kesimpulan),
        ];

        // Ganti placeholder di header, body, footer
        foreach ($data as $key => $val) {
            $regexCurly = "/{{\s*$key\s*}}/i";
            $regexBracket = "/\[$key\]/i";

            $header = preg_replace($regexCurly, $val, $header);
            $header = preg_replace($regexBracket, $val, $header);

            $body = preg_replace($regexCurly, $val, $body);
            $body = preg_replace($regexBracket, $val, $body);

            $footer = preg_replace($regexCurly, $val, $footer);
            $footer = preg_replace($regexBracket, $val, $footer);
        }

        $pdf = Pdf::loadView('supervisor.laporan.pdf', compact('header', 'body', 'footer'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("Laporan_{$laporan->tanggal}.pdf");
    }


    // ------------------ Approve / Reject ------------------
    public function approveSuratTugas($id)
    {
        $surat = SuratTugas::findOrFail($id);
        $surat->update(['status' => 'approved', 'catatan_supervisor' => null]);
        return back()->with('success', 'Surat Tugas disetujui');
    }

    public function rejectSuratTugas(Request $request, $id)
    {
        $surat = SuratTugas::findOrFail($id);
        $surat->update(['status' => 'rejected', 'catatan_supervisor' => $request->catatan_supervisor]);
        return back()->with('success', 'Surat Tugas ditolak');
    }

    public function approveSuratPengantar($id)
    {
        $surat = SuratPengantar::findOrFail($id);
        $surat->update(['status' => 'approved', 'catatan_supervisor' => null]);
        return back()->with('success', 'Surat Pengantar disetujui');
    }

    public function rejectSuratPengantar(Request $request, $id)
    {
        $surat = SuratPengantar::findOrFail($id);
        $surat->update(['status' => 'rejected', 'catatan_supervisor' => $request->catatan_supervisor]);
        return back()->with('success', 'Surat Pengantar ditolak');
    }

    public function approveLaporan($id)
    {
        $laporan = LaporanPenyelidikan::findOrFail($id);
        $laporan->update(['status' => 'approved', 'catatan_supervisor' => null]);
        return back()->with('success', 'Laporan disetujui');
    }

    public function rejectLaporan(Request $request, $id)
    {
        $laporan = LaporanPenyelidikan::findOrFail($id);
        $laporan->update(['status' => 'rejected', 'catatan_supervisor' => $request->catatan_supervisor]);
        return back()->with('success', 'Laporan ditolak');
    }
}
