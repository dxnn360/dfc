<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentTemplate;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = DocumentTemplate::all();
        return view('admin.templates.index', compact('templates'));
    }

    public function edit($type)
    {
        $template = DocumentTemplate::firstOrCreate(['type' => $type]);

        $placeholders = match ($type) {
            'surat_tugas' => [
                '{{daftar_ahli}}' => 'Nama Ahli',
                '{{nomor_surat}}' => 'Nomor Surat',
                '{{tanggal}}' => 'Tanggal',
                '{{sumber}}' => 'Sumber Permintaan',
                '{{ringkasan}}' => 'Ringkasan Kasus',
            ],
            'surat_pengantar' => [
                '{{nomor_surat}}' => 'Nomor Surat Pemeriksaan',
                '{{tanggal}}' => 'Tanggal',
                '{{nama_pemohon}}' => 'Nama Pemohon',
                '{{jabatan_pemohon}}' => 'Jabatan Pemohon',
                '{{klasifikasi}}' => 'Klasifikasi Surat',
                '{{barang_bukti}}' => 'Barang Bukti',
            ],
            'laporan_penyelidikan' => [
                '{{info}}' => 'Informasi Pemeriksaan',
                '{{nama_pemohon}}' => 'Nama Pemohon',
                '{{jabatan_pemohon}}' => 'Unit Kerja Pemohon',
                '{{barang_bukti}}' => 'Barang Bukti',
                '{{tujuan}}' => 'Tujuan Pemeriksaan',
                '{{metodologi}}' => 'Metodologi',
                '{{sumber}}' => 'Sumber',
                '{{hasil}}' => 'Hasil Pemeriksaan',
                '{{kesimpulan}}' => 'Kesimpulan',
            ],
            default => []
        };

        return view('admin.templates.edit', compact('template', 'type', 'placeholders'));
    }

    public function update(Request $request, $type)
    {
        $template = DocumentTemplate::firstOrCreate(['type' => $type]);

        $template->update([
            'header' => $request->header,   // tambahin ini
            'footer' => $request->footer,   // tambahin ini
            'format_tanggal' => $request->format_tanggal,
            'nomor_format' => $request->nomor_format,
            'body' => $request->body,
        ]);

        // khusus untuk logo yang memang file
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('templates', 'public');
            $template->update(['logo' => $path]);
        }

        return redirect()->route('admin.dashboard')
            ->with('success', 'Template berhasil diperbarui!');
    }

}

