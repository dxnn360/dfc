<x-app-layout>
    <div class="flex gap-6">
        <!-- Left: Detail Info -->
        <div class="w-1/2 p-6 bg-white rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-4">Detail Laporan Pemeriksaan</h2>
            <p><strong>Informasi Pemeriksaan:</strong> {{ $laporan->info }}</p>
            <p><strong>Nama Pemohon:</strong> {{ $laporan->nama_pemohon }}</p>
            <p><strong>Unit Kerja Pemohon:</strong> {{ $laporan->jabatan_pemohon }}</p>
            <p><strong>Tujuan Pemeriksaan:</strong> {{ $laporan->tujuan }}</p>
            <p><strong>Metodologi:</strong> {{ $laporan->metodologi }}</p>
            <p><strong>Sumber:</strong> {{ $laporan->sumber }}</p>
            <p><strong>Hasil Pemeriksaan:</strong> {{ $laporan->hasil }}</p>
            <p><strong>Kesimpulan:</strong> {{ $laporan->kesimpulan }}</p>
            <p><strong>Status:</strong> {{ ucfirst($laporan->status) }}</p>
            @if($laporan->catatan_supervisor)
                <p><strong>Catatan Supervisor:</strong> {{ $laporan->catatan_supervisor }}</p>
            @endif

            <h3 class="mt-4 font-semibold">Barang Bukti</h3>
            <ul class="list-disc ml-5">
                @foreach(explode(',', $laporan->barang_bukti) as $bb)
                    <li>{{ $bb }}</li>
                @endforeach
            </ul>

            <!-- Approve / Reject -->
            <form action="{{ route('supervisor.laporan.approve', $laporan->id) }}" method="POST" class="mt-6">
                @csrf
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Approve</button>
            </form>

            <form action="{{ route('supervisor.laporan.reject', $laporan->id) }}" method="POST" class="mt-2">
                @csrf
                <textarea name="catatan_supervisor" placeholder="Catatan jika ditolak" class="w-full border rounded p-2 mb-2"></textarea>
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Reject</button>
            </form>
        </div>

        <!-- Right: PDF Preview -->
        <div class="w-1/2">
            <iframe src="{{ route('supervisor.laporan.pdf', $laporan->id) }}" class="w-full h-[800px] border rounded"></iframe>
        </div>
    </div>
</x-app-layout>
