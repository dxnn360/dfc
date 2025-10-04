<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenyelidikan;
use App\Models\DocumentTemplate;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $next = $last ? intval(explode('/', $last->nomor_surat)[0]) + 1 : 1;
        return str_pad($next, 3, '0', STR_PAD_LEFT) . '/LAP/' . date('Y');
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
            'user_id'         => auth()->id(),
            'nomor_surat'     => $nomorSurat,
            'tanggal'         => $request->tanggal,
            'nama_pemohon'    => $request->nama_pemohon,
            'jabatan_pemohon' => $request->jabatan_pemohon,
            'informasi_pemeriksaan' => $request->informasi_pemeriksaan,
            'barang_bukti'    => $request->barang_bukti, // array
            'tujuan_pemeriksaan' => $request->tujuan_pemeriksaan,
            'metodologi'      => $request->metodologi,
            'sumber'          => collect($request->jenis_sumber)
                                    ->map(fn($j, $i) => [
                                        'jenis' => $j,
                                        'penjelasan' => $request->penjelasan_sumber[$i] ?? null
                                    ])->toArray(),
            'hasil_pemeriksaan' => $request->hasil_pemeriksaan,
            'kesimpulan'      => $request->kesimpulan,
            'catatan_supervisor' => null,
            'status'          => 'draft',
        ]);

        return redirect()->route('analis.laporan.edit', $laporan->id)
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
            'tanggal'         => $request->tanggal,
            'nama_pemohon'    => $request->nama_pemohon,
            'jabatan_pemohon' => $request->jabatan_pemohon,
            'informasi_pemeriksaan' => $request->informasi_pemeriksaan,
            'barang_bukti'    => $request->barang_bukti,
            'tujuan_pemeriksaan' => $request->tujuan_pemeriksaan,
            'metodologi'      => $request->metodologi,
            'sumber'          => collect($request->jenis_sumber)
                                    ->map(fn($j, $i) => [
                                        'jenis' => $j,
                                        'penjelasan' => $request->penjelasan_sumber[$i] ?? null
                                    ])->toArray(),
            'hasil_pemeriksaan' => $request->hasil_pemeriksaan,
            'kesimpulan'      => $request->kesimpulan,
            'catatan_supervisor' => $request->catatan_supervisor,
            'status'          => $request->status ?? $laporan->status,
        ]);

        return redirect()->route('analis.laporan.index')
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Delete laporan
     */
    public function destroy(LaporanPenyelidikan $laporan)
    {
        $laporan->delete();
        return redirect()->route('analis.laporan.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }

    /**
     * Preview / download PDF
     */
    public function download(LaporanPenyelidikan $laporan)
    {
        $template = DocumentTemplate::where('type', 'laporan_penyelidikan')->firstOrFail();

        $replace = [
            '{{nomor_surat}}' => $laporan->nomor_surat,
            '{{tanggal}}'     => Carbon::parse($laporan->tanggal)->translatedFormat('d F Y'),
            '{{nama_pemohon}}' => $laporan->nama_pemohon,
            '{{jabatan_pemohon}}' => $laporan->jabatan_pemohon,
            '{{info}}'        => $laporan->informasi_pemeriksaan,
            '{{barang_bukti}}' => $this->buildBarangBukti($laporan->barang_bukti),
            '{{tujuan}}'      => $laporan->tujuan_pemeriksaan,
            '{{metodologi}}'  => $laporan->metodologi,
            '{{sumber}}'      => $this->buildSumber($laporan->sumber),
            '{{hasil}}'       => $laporan->hasil_pemeriksaan,
            '{{kesimpulan}}'  => $laporan->kesimpulan,
        ];

        $header = str_replace(array_keys($replace), array_values($replace), $template->header);
        $body   = str_replace(array_keys($replace), array_values($replace), $template->body);
        $footer = str_replace(array_keys($replace), array_values($replace), $template->footer);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('analis.laporan_penyelidikan.pdf', compact('header', 'body', 'footer'));
        return $pdf->download("Laporan_Penyelidikan_{$laporan->tanggal}" . '.pdf');
    }

    /**
     * Helpers
     */
    private function buildBarangBukti($items)
    {
        if (!$items || !is_array($items)) return '<p>Tidak ada barang bukti</p>';
        $rows = '';
        foreach ($items as $i => $val) {
            $rows .= "<tr><td>".($i+1)."</td><td>".e($val)."</td></tr>";
        }
        return "<table border='1' width='100%'>
            <thead><tr><th>No</th><th>Barang Bukti</th></tr></thead>
            <tbody>$rows</tbody></table>";
    }

    private function buildSumber($sumber)
    {
        if (!$sumber || !is_array($sumber)) return '<p>Tidak ada sumber</p>';
        $rows = '';
        foreach ($sumber as $i => $row) {
            $rows .= "<tr><td>".($i+1)."</td><td>".e($row['jenis'])."</td><td>".e($row['penjelasan'])."</td></tr>";
        }
        return "<table border='1' width='100%'>
            <thead><tr><th>No</th><th>Jenis</th><th>Penjelasan</th></tr></thead>
            <tbody>$rows</tbody></table>";
    }
}
