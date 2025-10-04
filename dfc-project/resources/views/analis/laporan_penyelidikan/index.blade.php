<x-app-layout>
    <div class="px-6 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Laporan Penyelidikan</h1>
            <a href="{{ route('analis.laporan.create') }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded">+ Buat Laporan</a>
        </div>

        <div class="bg-white shadow rounded p-4">
            <table class="w-full border-collapse border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-3 py-2">No</th>
                        <th class="border px-3 py-2">Nomor Surat</th>
                        <th class="border px-3 py-2">Nama Pemohon</th>
                        <th class="border px-3 py-2">Tanggal</th>
                        <th class="border px-3 py-2">Status</th>
                        <th class="border px-3 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(is_iterable($laporan) ? $laporan : [] as $item)
                        <tr>
                            <td class="border px-3 py-2">{{ $loop->iteration }}</td>
                            <td class="border px-3 py-2">{{ is_object($item) && isset($item->nomor_surat) ? $item->nomor_surat : '-' }}</td>
                            <td class="border px-3 py-2">{{ is_object($item) && isset($item->nama_pemohon) ? $item->nama_pemohon : '-' }}</td>
                            <td class="border px-3 py-2">
                                {{ is_object($item) && isset($item->tanggal) ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') : '-' }}
                            </td>
                            <td class="border px-3 py-2">
                                <span class="px-2 py-1 text-sm rounded 
                                    {{ (is_object($item) && isset($item->status) && $item->status === 'draft') ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                    {{ is_object($item) && isset($item->status) ? ucfirst($item->status) : '-' }}
                                </span>
                            </td>
                            <td class="border px-3 py-2 space-x-2">
                                @if(is_object($item) && isset($item->id))
                                    <a href="{{ route('analis.laporan.edit', $item->id) }}" class="text-blue-600">Edit</a>
                                    <a href="{{ route('analis.laporan.download', $item->id) }}" class="text-green-600">Download</a>
                                    <form action="{{ route('analis.laporan.destroy', $item->id) }}" 
                                          method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus?')" 
                                                class="text-red-600">Hapus</button>
                                    </form>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border px-3 py-2 text-center text-gray-500">Belum ada laporan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
