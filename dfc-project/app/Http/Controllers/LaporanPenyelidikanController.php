<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenyelidikan;
use App\Models\DocumentTemplate;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Pharaonic\Hijri\HijriCarbon;
use Str;

Carbon::mixin(HijriCarbon::class);

class LaporanPenyelidikanController extends Controller
{
    /**
     * List laporan
     */
    public function index()
    {
        $laporan = LaporanPenyelidikan::orderBy('created_at', 'desc')->get();
        return view('analis.laporan_penyelidikan.index', compact('laporan'));
    }

    /**
     * Generate nomor surat
     */
    private function generateNomorSurat()
    {
        $last = LaporanPenyelidikan::orderBy('id', 'desc')->first();

        if ($last) {
            // Ambil nomor urut dari string "BAP No. Lab DFC No XXX"
            preg_match('/BAP No\. Lab DFC No (\d+)/', $last->nomor_surat, $matches);
            $next = isset($matches[1]) ? intval($matches[1]) + 1 : 200;
        } else {
            $next = 200; // start dari 200 kalau belum ada record
        }

        $bulan = Carbon::now()->format('n');
        $bulanRomawi = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];

        return sprintf(
            "BAP No. Lab DFC No %s/BB/DFC/%s/%s",
            str_pad($next, 3, '0', STR_PAD_LEFT),
            $bulanRomawi[$bulan - 1],
            Carbon::now()->format('Y')
        );
    }


    /**
     * Form create
     */
    public function create()
    {
        $template = DocumentTemplate::where('type', 'laporan_penyelidikan')->first();
        $nomorSurat = $this->generateNomorSurat();

        return view('analis.laporan_penyelidikan.create', compact('template', 'nomorSurat'));
    }

    /**
     * Store laporan
     */
    public function store(Request $request)
    {
        $nomorSurat = $this->generateNomorSurat();

        $laporan = LaporanPenyelidikan::create([
            'user_id' => auth()->id(),
            'nomor_surat' => $nomorSurat,
            'tanggal' => $request->tanggal,
            'nama_pemohon' => $request->nama_pemohon,
            'jabatan_pemohon' => $request->jabatan_pemohon,
            'pekerjaan' => $request->pekerjaan,
            'organisasi' => $request->organisasi,
            'sumber_permintaan' => $request->sumber_permintaan,
            'no_telp' => $request->no_telp,
            'status_barang_bukti' => $request->status_barang_bukti ?? 'Belum Dikirimkan',
            'informasi_pemeriksaan' => $request->informasi_pemeriksaan,
            'barang_bukti' => $request->barang_bukti ?? '', // array
            'tujuan_pemeriksaan' => $request->tujuan_pemeriksaan,
            'metodologi' => $request->metodologi,
            'sumber' => collect($request->jenis_sumber)
                ->map(fn($j, $i) => [
                    'jenis' => $j,
                    'penjelasan' => $request->penjelasan_sumber[$i] ?? null
                ])->toArray(),
            'hasil_pemeriksaan' => $request->hasil_pemeriksaan,
            'kesimpulan' => $request->kesimpulan,
            'catatan_supervisor' => null,
            'status' => 'draft',
        ]);

        return redirect()->route('analis.document')
            ->with('success', 'Laporan berhasil disimpan sebagai draft.');
    }

    /**
     * Edit laporan
     */
    public function edit(LaporanPenyelidikan $laporan)
    {
        $template = DocumentTemplate::where('type', 'laporan_penyelidikan')->first();
        return view('analis.laporan_penyelidikan.edit', compact('laporan', 'template'));
    }

    /**
     * Update laporan
     */
    public function update(Request $request, LaporanPenyelidikan $laporan)
    {
        $laporan->update([
            'tanggal' => $request->tanggal,
            'nama_pemohon' => $request->nama_pemohon,
            'jabatan_pemohon' => $request->jabatan_pemohon,
            'pekerjaan' => $request->pekerjaan,
            'organisasi' => $request->organisasi,
            'status_barang_bukti' => $request->status_barang_bukti,
            'sumber_permintaan' => $request->sumber_permintaan,
            'no_telp' => $request->no_telp,
            'informasi_pemeriksaan' => $request->informasi_pemeriksaan,
            'barang_bukti' => $request->barang_bukti,
            'tujuan_pemeriksaan' => $request->tujuan_pemeriksaan,
            'metodologi' => $request->metodologi,
            'sumber' => collect($request->jenis_sumber)
                ->map(fn($j, $i) => [
                    'jenis' => $j,
                    'penjelasan' => $request->penjelasan_sumber[$i] ?? null
                ])->toArray(),
            'hasil_pemeriksaan' => $request->hasil_pemeriksaan,
            'kesimpulan' => $request->kesimpulan,
            'catatan_supervisor' => $request->catatan_supervisor,
            'status' => $request->status ?? $laporan->status,
        ]);

        return redirect()->route('analis.document')
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Delete laporan
     */
    public function destroy(LaporanPenyelidikan $laporan)
    {
        $laporan->delete();
        return redirect()->route('analis.document')
            ->with('success', 'Laporan berhasil dihapus.');
    }

    /**
     * Preview / download PDF
     */
    public function downloadFullReport(LaporanPenyelidikan $laporan)
    {
        $bulan = Carbon::parse($laporan->tanggal)->translatedFormat('F');
        $tahun = Carbon::parse($laporan->tanggal)->translatedFormat('Y');

        $template = DocumentTemplate::where('type', 'laporan_penyelidikan')->firstOrFail();

        $user = auth()->user();

        $ahliText = "____________________1. " . $user->name . ",_____________________\n";
        $ahliText .= "Analis pemeriksaan forensik digital di Digital Forensics Center Universitas Muhammadiyah Purwokerto Jabatan {$user->position}\n\n";

        $barangBukti = $laporan->barang_bukti;

        $barangBukti = preg_replace_callback('/<img.*?src=["\'](.*?)["\'].*?>/i', function ($matches) {
            $src = $matches[1];
            // Jika src berasal dari storage, ubah ke public_path
            if (Str::contains($src, '/storage/')) {
                $path = public_path(str_replace(asset(''), '', $src));
                return str_replace($src, $path, $matches[0]);
            }
            return $matches[0];
        }, $barangBukti);

        // Replace placeholders body
        $replace = [
            '{{nomor_surat}}' => $laporan->nomor_surat,
            '{{tanggal}}' => \Carbon\Carbon::parse($laporan->tanggal)->locale('id')->translatedFormat('d F Y'),
            '{{tanggal_hijriyah}}' => \Carbon\Carbon::parse($laporan->tanggal)->toHijri()->isoFormat('DD MMMM YYYY'),
            '{{nama_pemohon}}' => $laporan->nama_pemohon,
            '{{jabatan_pemohon}}' => $laporan->jabatan_pemohon,
            '{{sumber_permintaan}}' => $laporan->sumber_permintaan,
            '{{pekerjaan}}' => $laporan->pekerjaan,
            '{{organisasi}}' => $laporan->organisasi,
            '{{info}}' => $laporan->informasi_pemeriksaan,
            '{{barang_bukti}}' => $barangBukti,
            '{{tujuan}}' => $laporan->tujuan_pemeriksaan,
            '{{metodologi}}' => $laporan->metodologi,
            '{{sumber}}' => $this->buildSumber($laporan->sumber),
            '{{hasil}}' => $laporan->hasil_pemeriksaan,
            '{{kesimpulan}}' => $laporan->kesimpulan,
            '{{daftar_ahli}}' => $ahliText,
            '{{nama_analis}}' => $user->name,
        ];

        $header = str_replace(array_keys($replace), array_values($replace), $template->header);
        $body = str_replace(array_keys($replace), array_values($replace), $template->body);
        $footer = str_replace(array_keys($replace), array_values($replace), $template->footer);

        // Load view dengan cover + halaman tambahan + body
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('analis.laporan_penyelidikan.full_report', compact(
            'laporan',
            'bulan',
            'tahun',
            'header',
            'body',
            'footer'
        ));

        return $pdf->stream("Laporan_Penyelidikan_{$laporan->id}.pdf");
    }


    /**
     * Helpers
     */
    private function buildBarangBukti($items)
    {
        if (!$items || !is_array($items))
            return '<p style="font-size:12px">Tidak ada barang bukti</p>';
        $rows = '';
        foreach ($items as $i => $val) {
            $rows .= "<tr style='font-size:12px'><td style='font-size:10px;width:30px'>" . ($i + 1) . "</td><td>" . e($val) . "</td></tr>";
        }
        return "<table border='1' width='100%' style='font-size:12px'>
            <thead><tr><th style='width:30px'>No</th><th>Barang Bukti</th></tr></thead>
            <tbody>$rows</tbody></table>";
    }

    private function buildSumber($sumber)
    {
        if (!$sumber || !is_array($sumber))
            return '<p style="font-size:12px">Tidak ada sumber</p>';
        $rows = '';
        foreach ($sumber as $i => $row) {
            $rows .= "<tr style='font-size:12px'><td>" . e($row['jenis']) . "</td><td>" . e($row['penjelasan']) . "</td></tr>";
        }
        return "<table border='1' width='100%' style='font-size:12px'>
            <thead><tr><th>Sumber (source)</th><th>Hash Value (MD5)</th></tr></thead>
            <tbody>$rows</tbody></table>";
    }


    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:5120', // max 5MB
        ]);

        $file = $request->file('file');

        // Simpan file ke storage/public/laporan-images
        $path = $file->store('laporan-images', 'public');

        // Kembalikan URL supaya Summernote bisa insert ke editor
        return response()->json(['url' => asset('storage/' . $path)]);
    }

    public function uploadBarangBukti(Request $request, LaporanPenyelidikan $laporan)
    {
        $laporan->update([
            'barang_bukti' => $request->barang_bukti ?? '',
            'status_barang_bukti' => $request->status_barang_bukti,
        ]);
        return redirect()->route('analis.laporan.view-barang-bukti')->with('success', 'Barang bukti berhasil diperbarui.');
    }

    public function formUploadBarangBukti(LaporanPenyelidikan $laporan)
    {
        return view('analis.laporan_penyelidikan.upload_barang_bukti', compact('laporan'));
    }


    public function viewBarangBukti()
    {
        $laporan = LaporanPenyelidikan::orderBy('created_at', 'desc')->get();
        return view('analis.laporan_penyelidikan.view_barang_bukti', compact('laporan'));
    }

}
