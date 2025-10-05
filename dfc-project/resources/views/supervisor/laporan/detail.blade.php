<x-app-layout>
    <div class="p-2 flex gap-2 max-w-6xl">
        <!-- KIRI: Detail Laporan -->
        <div class="w-1/2 bg-white rounded-xl shadow p-6 overflow-auto break-words">
            <h1 class="text-2xl font-bold mb-4">Detail Laporan Pemeriksaan</h1>

            @php
                // Pastikan semua field yang bisa berupa array di-decode dengan aman
                $info = is_array($laporan->informasi_pemeriksaan) ? $laporan->informasi_pemeriksaan : json_decode($laporan->informasi_pemeriksaan, true) ?? [$laporan->informasi_pemeriksaan];
                $metodologi = is_array($laporan->metodologi) ? $laporan->metodologi : json_decode($laporan->metodologi, true) ?? [$laporan->metodologi];
                $sumber = is_array($laporan->sumber) ? $laporan->sumber : json_decode($laporan->sumber, true) ?? [$laporan->sumber];
                $barangBukti = is_array($laporan->barang_bukti) ? $laporan->barang_bukti : json_decode($laporan->barang_bukti, true) ?? [$laporan->barang_bukti];
            @endphp

            <p><strong>Informasi Pemeriksaan:</strong></p>
            <ul>
                @foreach($info as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>

            <p><strong>Nama Pemohon:</strong> {{ $laporan->nama_pemohon }}</p>
            <p><strong>Unit Kerja Pemohon:</strong> {{ $laporan->jabatan_pemohon }}</p>
            <p><strong>Tujuan Pemeriksaan:</strong> {{ $laporan->tujuan_pemeriksaan }}</p>

            <p><strong>Metodologi:</strong></p>
            <ul>
                @foreach($metodologi as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>

            <p><strong>Sumber:</strong></p>
            <ul>
                @foreach($sumber as $item)
                    <li>
                        @if(is_array($item))
                            {{ implode(', ', $item) }}
                        @else
                            {{ $item }}
                        @endif
                    </li>
                @endforeach
            </ul>


            <p><strong>Barang Bukti:</strong></p>
            <ul>
                @foreach($barangBukti as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>

            <p><strong>Kesimpulan:</strong></p>
            <p>{{ $laporan->kesimpulan }}</p>

            <!-- TOMBOL APPROVE / REJECT -->
            <div class="mt-6 flex gap-3">
                <form action="{{ route('supervisor.laporan.approve', $laporan->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Approve</button>
                </form>

                <form action="{{ route('supervisor.laporan.reject', $laporan->id) }}" method="POST">
                    @csrf
                    <input type="text" name="catatan_supervisor" placeholder="Catatan..."
                        class="border px-2 py-1 rounded">
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Reject</button>
                </form>
            </div>
        </div>

        <!-- KANAN: PDF Preview -->
        <div class="w-1/2">
            <iframe src="{{ route('supervisor.laporan.pdf', $laporan->id) }}"
                class="w-full h-[90vh] border rounded-xl"></iframe>
        </div>
    </div>
</x-app-layout>