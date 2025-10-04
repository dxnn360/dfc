<div class="overflow-x-auto">
    <table class="w-full border-collapse border border-gray-300 text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-3 py-2">No</th>
                <th class="border px-3 py-2">Judul Laporan</th>
                <th class="border px-3 py-2">Status</th>
                <th class="border px-3 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $i => $item)
                <tr>
                    <td class="border px-3 py-2 text-center">{{ $i+1 }}</td>
                    <td class="border px-3 py-2">{{ $item->nomor_surat }}</td>
                    <td class="border px-3 py-2">
                        <span class="px-2 py-1 text-xs rounded-full 
                            {{ $item->status === 'approved' ? 'bg-green-500 text-white' : 
                               ($item->status === 'rejected' ? 'bg-red-500 text-white' : 'bg-gray-400 text-white') }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="border px-3 py-2 space-x-1">
                        <a href="{{ route('supervisor.laporan.detail', $item->id) }}" 
                           class="px-3 py-1 bg-blue-500 text-white rounded">Detail</a>

                        <form action="{{ route('supervisor.laporan.approve', $item->id) }}" method="POST" class="inline">
                            @csrf
                            <button class="px-3 py-1 bg-green-500 text-white rounded">ACC</button>
                        </form>

                        <form action="{{ route('supervisor.laporan.reject', $item->id) }}" method="POST" class="inline">
                            @csrf
                            <input type="text" name="catatan_supervisor" placeholder="Catatan"
                                   class="border rounded px-2 py-1 text-sm">
                            <button class="px-3 py-1 bg-red-500 text-white rounded">Revisi</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
