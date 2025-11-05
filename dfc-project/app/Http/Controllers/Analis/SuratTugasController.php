<?php

namespace App\Http\Controllers\Analis;

use App\Http\Controllers\Controller;
use App\Models\SuratTugas;
use App\Models\DocumentTemplate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Pharaonic\Hijri\HijriCarbon;

Carbon::mixin(HijriCarbon::class);

class SuratTugasController extends Controller
{
    public function index()
    {
        $suratTugas = SuratTugas::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('analis.surat_tugas.index', compact('suratTugas'));
    }


    private function generateNomorSurat()
    {
        $last = SuratTugas::orderBy('id', 'desc')->first();

        // Ambil nomor urut, mulai dari 200 kalau belum ada record
        $next = $last
            ? intval(explode('/', $last->nomor_surat)[0]) + 1
            : 200;

        $bulan = Carbon::now()->format('n');
        $bulanRomawi = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];

        return sprintf(
            "%03d/S.Tu/DFC/%s/%s", // %03d = pad 3 digit
            $next,
            $bulanRomawi[$bulan - 1],
            Carbon::now()->format('Y')
        );
    }

    public function create()
    {
        $template = DocumentTemplate::where('type', 'surat_tugas')->first();

        $users = User::whereHas('roles', function ($q) {
            $q->whereIn('name', ['analis', 'supervisor']);
        })->get();

        $lastSurat = SuratTugas::orderBy('id', 'desc')->first();
        $nextNumber = $lastSurat ? $lastSurat->id + 1 : 1;
        $nomorSurat = $this->generateNomorSurat();

        return view('analis.surat_tugas.create', compact('template', 'users', 'nomorSurat'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'sumber_permintaan' => 'required|string',
            'ringkasan_kasus' => 'required|string',
            'nama_pemohon' => 'required|string',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $last = SuratTugas::orderBy('id', 'desc')->first();
        $nextNumber = $last ? $last->id + 1 : 1;
        $nomorSurat = "ST-" . str_pad($nextNumber, 3, "0", STR_PAD_LEFT) . "/IX/" . date('Y');

        $suratTugas = SuratTugas::create([
            'user_id' => auth()->id(),
            'tanggal' => $data['tanggal'],
            'sumber_permintaan' => $data['sumber_permintaan'],
            'ringkasan_kasus' => $data['ringkasan_kasus'],
            'nama_pemohon' => $data['nama_pemohon'],
            'status' => 'pending',
            'nomor_surat' => $nomorSurat,
        ]);

        $suratTugas->users()->attach($data['user_ids']);

        return redirect()->route('analis.document')
            ->with('success', 'Surat Tugas berhasil dibuat dan menunggu verifikasi supervisor.');
    }

    public function show(SuratTugas $surat_tugas)
    {
        return view('analis.dashboard', compact('surat_tugas'));
    }

    public function edit(SuratTugas $surat_tugas)
    {
        $template = DocumentTemplate::where('type', 'surat_tugas')->first();

        $users = User::whereHas('roles', function ($q) {
            $q->whereIn('name', ['analis', 'supervisor']);
        })->get();

        $selectedUsers = $surat_tugas->users->pluck('id')->toArray();

        return view('analis.surat_tugas.edit', compact('surat_tugas', 'template', 'users', 'selectedUsers'));
    }

    public function update(Request $request, SuratTugas $surat_tugas)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'sumber_permintaan' => 'required|string',
            'ringkasan_kasus' => 'required|string',
            'nama_pemohon' => 'required|string|max:255',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $surat_tugas->update([
            'tanggal' => $data['tanggal'],
            'sumber_permintaan' => $data['sumber_permintaan'],
            'ringkasan_kasus' => $data['ringkasan_kasus'],
            'nama_pemohon' => $data['nama_pemohon'],
            'status' => 'pending', // setiap update balik lagi ke pending
        ]);

        $surat_tugas->users()->sync($data['user_ids']);

        return redirect()->route('analis.document')
            ->with('success', 'Surat Tugas berhasil diperbarui.');
    }

    public function destroy(SuratTugas $surat_tugas)
    {
        $surat_tugas->delete();

        return redirect()->route('analis.document')
            ->with('success', 'Surat Tugas berhasil dihapus.');
    }

    public function download(SuratTugas $surat_tugas)
    {
        $template = DocumentTemplate::where('type', 'surat_tugas')->first();

        $header = $template?->header ?? '';
        $body = $template?->body ?? '';
        $footer = $template?->footer ?? '';

        // tabel daftar ahli
        $ahliTable = view('analis.surat_tugas.partials.ahli_table', [
            'users' => $surat_tugas->users
        ])->render();

        $data = [
            'tanggal' => Carbon::parse($surat_tugas->tanggal)->translatedFormat('d F Y'),
            'tanggal_hijriyah' => Carbon::parse($surat_tugas->tanggal)->toHijri()->isoFormat('DD MMMM YYYY'),
            'sumber' => $surat_tugas->sumber_permintaan,
            'ringkasan' => $surat_tugas->ringkasan_kasus,
            'nama_pemohon' => $surat_tugas->nama_pemohon,
            'nomor_surat' => $surat_tugas->nomor_surat,
            'daftar_ahli' => $ahliTable,
            'status' => $surat_tugas->status,
            'catatan_supervisor' => $surat_tugas->catatan_supervisor ?? '-',
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

        $pdf = Pdf::loadView('analis.surat_tugas.pdf', [
            'header' => $header,
            'body' => $body,
            'footer' => $footer,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream("001_SURAT TUGAS AHLI DFC_{$surat_tugas->tanggal}.pdf");
    }

    public function preview(SuratTugas $surat_tugas)
    {
        $template = DocumentTemplate::where('type', 'surat_tugas')->first();

        $header = $template?->header ?? '';
        $body = $template?->body ?? '';
        $footer = $template?->footer ?? '';

        $ahliTable = view('analis.surat_tugas.partials.ahli_table', [
            'users' => $surat_tugas->users
        ])->render();

        $data = [
            'tanggal' => Carbon::parse($surat_tugas->tanggal)->translatedFormat('d F Y'),
            'sumber' => $surat_tugas->sumber_permintaan,
            'ringkasan' => $surat_tugas->ringkasan_kasus,
            'nama_pemohon' => $surat_tugas->nama_pemohon,
            'nomor_surat' => $surat_tugas->nomor_surat,
            'daftar_ahli' => $ahliTable,
            'status' => $surat_tugas->status,
            'catatan_supervisor' => $surat_tugas->catatan_supervisor ?? '-',
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

        return view('analis.surat_tugas.preview_html', [
            'header' => $header,
            'body' => $body,
            'footer' => $footer,
            'surat_tugas' => $surat_tugas
        ]);
    }

}
