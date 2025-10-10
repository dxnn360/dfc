<?php

namespace App\Http\Controllers;

use App\Models\SuratPengantar;
use App\Models\DocumentTemplate;
use App\Models\LaporanPenyelidikan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class SuratPengantarController extends Controller
{
    public function index()
    {
        $documents = SuratPengantar::latest()->get();
        return view('analis.surat_pengantar.index', compact('documents'));
    }

    public function create()
    {
        $template = DocumentTemplate::where('type', 'surat_pengantar')->first();
        $last = SuratPengantar::latest()->first();
        $nomorSurat = 'SP-' . str_pad(($last?->id ?? 0) + 1, 4, '0', STR_PAD_LEFT) . '/X/' . now()->year;

        $klasifikasiOptions = ['Rahasia', 'Segera', 'Penting', 'Biasa'];
        $laporanList = LaporanPenyelidikan::get();

        return view('analis.surat_pengantar.create', compact('template', 'nomorSurat', 'klasifikasiOptions', 'laporanList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string',
            'tanggal' => 'required|date',
            'nama_pemohon' => 'required|string',
            'jabatan_pemohon' => 'required|string',
            'klasifikasi' => 'required|string',
            'barang_bukti' => 'required|array|min:1',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'draft'; // default
        $validated['barang_bukti'] = $request->barang_bukti;

        SuratPengantar::create($validated);

        return redirect()->route('analis.document')->with('success', 'Surat Pengantar berhasil dibuat!');
    }

    public function edit(SuratPengantar $surat_pengantar)
    {
        $template = DocumentTemplate::where('type', 'surat_pengantar')->first();
        $klasifikasiOptions = ['Rahasia', 'Segera', 'Penting', 'Biasa'];
        $laporanList = LaporanPenyelidikan::get();

        return view('analis.surat_pengantar.edit', compact('template', 'surat_pengantar', 'klasifikasiOptions', 'laporanList'));
    }

    public function update(Request $request, SuratPengantar $surat_pengantar)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string',
            'tanggal' => 'required|date',
            'nama_pemohon' => 'required|string',
            'jabatan_pemohon' => 'required|string',
            'klasifikasi' => 'required|string',
            'barang_bukti' => 'required|array|min:1',
            'status' => 'in:draft,pending,approved,rejected',
            'catatan_supervisor' => 'nullable|string',
        ]);

        $validated['barang_bukti'] = $request->barang_bukti;

        $surat_pengantar->update($validated);

        return redirect()->route('analis.document')->with('success', 'Surat Pengantar berhasil diperbarui!');
    }

    public function destroy(SuratPengantar $surat_pengantar)
    {
        $surat_pengantar->delete();
        return back()->with('success', 'Surat Pengantar berhasil dihapus!');
    }

    public function download(SuratPengantar $surat_pengantar)
    {
        $template = DocumentTemplate::where('type', 'surat_pengantar')->first();

        $header = $template?->header ?? '';
        $body = $template?->body ?? '';
        $footer = $template?->footer ?? '';

        // Handle barang bukti
        $barangBuktiList = '';
        $items = $surat_pengantar->barang_bukti;

        // Jika barang_bukti masih string, coba decode
        if (is_string($items)) {
            $decoded = json_decode($items, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $items = $decoded;
            } else {
                $items = [$items]; // fallback single string
            }
        }

        // Jika array, buat tabel
        if (is_array($items)) {
            $barangBuktiList = "<table border='1' cellspacing='0' cellpadding='5' style='width:100%; border-collapse:collapse; font-size:12pt;'>
            <thead>
                <tr>
                    <th style='width:50px; text-align:center;'>No</th>
                    <th>Barang Bukti</th>
                </tr>
            </thead>
            <tbody>";

            foreach ($items as $i => $bb) {
                $barangBuktiList .= "<tr>
                <td style='text-align:center;'>" . ($i + 1) . "</td>
                <td>" . e($bb) . "</td>
            </tr>";
            }

            $barangBuktiList .= "</tbody></table>";
        }

        $data = [
            'nomor_surat' => $surat_pengantar->nomor_surat,
            'tanggal' => Carbon::parse($surat_pengantar->tanggal)->translatedFormat('d F Y'),
            'nama_pemohon' => $surat_pengantar->nama_pemohon,
            'jabatan_pemohon' => $surat_pengantar->jabatan_pemohon,
            'klasifikasi' => $surat_pengantar->klasifikasi,
            'barang_bukti' => $barangBuktiList,
            'status' => ucfirst($surat_pengantar->status ?? 'pending'),
            'catatan' => $surat_pengantar->catatan_supervisor ?? '-',
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

        $pdf = Pdf::loadView('analis.surat_pengantar.pdf', compact('header', 'body', 'footer'))
            ->setPaper('A4', 'portrait');

        return $pdf->download("Surat_Pengantar_{$surat_pengantar->tanggal}.pdf");
    }

}
