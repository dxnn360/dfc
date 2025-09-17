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
                '[NAMA_AHLI]' => 'Nama Ahli',
                '[JABATAN]' => 'Jabatan',
                '[NIP_NIK]' => 'NIP/NIK',
                '[NO_SURAT]' => 'Nomor Surat',
                '[TANGGAL]' => 'Tanggal',
                '[SUMBER]' => 'Sumber Permintaan',
                '[RINGKASAN]' => 'Ringkasan Kasus',
            ],
            'surat_pengantar' => [
                '[NO_SURAT]' => 'Nomor Surat Pemeriksaan',
                '[TANGGAL]' => 'Tanggal',
                '[DATA_PEMOHON]' => 'Data Pemohon',
                '[NO_SURAT_PERMINTAAN]' => 'Nomor Surat Permintaan',
                '[KLASIFIKASI]' => 'Klasifikasi Surat',
                '[BARANG_BUKTI]' => 'Barang Bukti',
            ],
            'laporan_penyelidikan' => [
                '[INFO]' => 'Informasi Pemeriksaan',
                '[NAMA_PEMOHON]' => 'Nama Pemohon',
                '[UNIT_KERJA]' => 'Unit Kerja Pemohon',
                '[BARANG_BUKTI]' => 'Barang Bukti',
                '[TUJUAN]' => 'Tujuan Pemeriksaan',
                '[METODOLOGI]' => 'Metodologi',
                '[SUMBER]' => 'Sumber',
                '[HASIL]' => 'Hasil Pemeriksaan',
                '[KESIMPULAN]' => 'Kesimpulan',
            ],
            default => []
        };

        return view('admin.templates.edit', compact('template', 'type', 'placeholders'));
    }

    public function update(Request $request, $type)
    {
        $template = DocumentTemplate::firstOrCreate(['type' => $type]);

        $template->update([
            'format_tanggal' => $request->format_tanggal,
            'nomor_format'   => $request->nomor_format,
            'body'           => $request->body,
        ]);

        // upload file opsional
        foreach (['header', 'footer', 'logo'] as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('templates', 'public');
                $template->update([$field => $path]);
            }
        }

        return redirect()->route('templates.index')->with('success', 'Template berhasil diperbarui!');
    }
}

