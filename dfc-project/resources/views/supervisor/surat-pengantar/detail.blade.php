<x-app-layout>
    <div class="flex gap-6">
        <!-- Left: Detail Info -->
        <div class="w-1/2 p-6 bg-white rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-4">Detail Surat Pengantar</h2>
            <p><strong>Nomor Surat:</strong> {{ $surat->nomor_surat }}</p>
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($surat->tanggal)->format('d F Y') }}</p>
            <p><strong>Nama Pemohon:</strong> {{ $surat->nama_pemohon }}</p>
            <p><strong>Jabatan Pemohon:</strong> {{ $surat->jabatan_pemohon }}</p>
            <p><strong>Klasifikasi:</strong> {{ $surat->klasifikasi }}</p>
            <p><strong>Status:</strong> {{ ucfirst($surat->status) }}</p>
            @if($surat->catatan_supervisor)
                <p><strong>Catatan Supervisor:</strong> {{ $surat->catatan_supervisor }}</p>
            @endif
            <h3 class="mt-4 font-semibold">Barang Bukti</h3>
            <table class="w-full table-auto border border-gray-200 rounded">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 text-left text-sm font-medium border-b">No</th>
                        <th class="px-3 py-2 text-left text-sm font-medium border-b">Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($surat->barang_bukti as $bb)
                        <tr class="@if($loop->odd) bg-white @else bg-gray-50 @endif">
                            <td class="px-3 py-2 text-sm border-b align-top">{{ $loop->iteration }}</td>
                            <td class="px-3 py-2 text-sm border-b">
                                @if(is_array($bb) || is_object($bb))
                                    {{ is_object($bb) ? json_encode($bb) : implode(', ', (array) $bb) }}
                                @else
                                    {{ $bb }}
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-3 py-2 text-sm text-gray-500">Tidak ada barang bukti.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Approve / Reject -->
            <form action="{{ route('supervisor.surat-pengantar.approve', $surat->id) }}" method="POST" class="mt-6">
                @csrf
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Approve</button>
            </form>

            <form action="{{ route('supervisor.surat-pengantar.reject', $surat->id) }}" method="POST" class="mt-2">
                @csrf
                <textarea name="catatan_supervisor" placeholder="Catatan jika ditolak" class="w-full border rounded p-2 mb-2"></textarea>
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Reject</button>
            </form>
        </div>

        <!-- Right: PDF Preview -->
        <div class="w-1/2">
            <iframe src="{{ route('supervisor.surat-pengantar.pdf', $surat->id) }}" class="w-full h-[800px] border rounded"></iframe>
        </div>
    </div>
</x-app-layout>
