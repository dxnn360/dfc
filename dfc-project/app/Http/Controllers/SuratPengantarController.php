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
            'sumber_permohonan' => 'required|string',
            'alamat' => 'required|string',
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
            'sumber_permohonan' => 'required|string',
            'alamat' => 'required|string',
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

        // === HANDLE BARANG BUKTI (4 KOLOM) ===
        $barangBuktiList = '';
        $items = $surat_pengantar->barang_bukti;

        // Decode jika masih string JSON
        if (is_string($items)) {
            $decoded = json_decode($items, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $items = $decoded;
            } else {
                $items = [$items]; // fallback single string
            }
        }

        // Buat tabel hanya kalau ada data
        if (!empty($items) && is_array($items)) {
            $barangBuktiList = "
        <table class='preview-table' style='width:100%; border-collapse:collapse; font-size:11pt;'>
            <thead>
                <tr>
                    <th style='width:40px; text-align:center;'>No</th>
                    <th style='text-align:left;'>Jenis yang dikirim</th>
                    <th style='width:120px; text-align:center;'>Banyaknya</th>
                    <th style='text-align:left;'>Keterangan</th>
                </tr>
            </thead>
            <tbody>";

            foreach ($items as $i => $bb) {
                // Jika setiap item adalah string biasa
                $barangBuktiList .= "
                <tr>
                    <td style='text-align:center; vertical-align:middle;'>" . ($i + 1) . "</td>
                    <td style='vertical-align:middle; word-wrap:break-word;'>" . e($bb) . "</td>
                    <td style='text-align:center; vertical-align:middle;'>Satu eksemplar</td>
                    <td style='vertical-align:middle; word-wrap:break-word;'>
                        Dikirimkan Kepada Kepala untuk dipergunakan seperlunya sesuai dengan " . e($surat_pengantar->sumber_permohonan) . ".
                    </td>
                </tr>";
            }

            $barangBuktiList .= "</tbody></table>";
        } else {
            $barangBuktiList = "<p><em>Tidak ada barang bukti yang tercantum.</em></p>";
        }

        // === REPLACE VARIABEL DALAM TEMPLATE ===
        $data = [
            'nomor_surat' => $surat_pengantar->nomor_surat,
            'tanggal' => \Carbon\Carbon::parse($surat_pengantar->tanggal)->translatedFormat('d F Y'),
            'nama_pemohon' => $surat_pengantar->nama_pemohon,
            'jabatan_pemohon' => $surat_pengantar->jabatan_pemohon,
            'klasifikasi' => $surat_pengantar->klasifikasi,
            'barang_bukti' => $barangBuktiList,
            'sumber_permohonan' => $surat_pengantar->sumber_permohonan,
            'alamat' => $surat_pengantar->alamat,
            'status' => ucfirst($surat_pengantar->status ?? 'Pending'),
            'catatan' => $surat_pengantar->catatan_supervisor ?? '-',
        ];

        foreach ($data as $key => $val) {
            $patterns = [
                "/{{\s*$key\s*}}/i",
                "/\[$key\]/i",
            ];
            $header = preg_replace($patterns, $val, $header);
            $body = preg_replace($patterns, $val, $body);
            $footer = preg_replace($patterns, $val, $footer);
        }

        // === GENERATE PDF ===
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('analis.surat_pengantar.pdf', compact('header', 'body', 'footer'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("SURAT_PENGANTAR_{$surat_pengantar->tanggal}.pdf");
    }


}
