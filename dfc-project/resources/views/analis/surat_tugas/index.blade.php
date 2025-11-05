<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Surat Tugas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('analis.surat_tugas.create') }}" 
                   class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
                    + Buat Surat Tugas
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left text-xs uppercase tracking-wider">
                            <th class="p-3 border">No</th>
                            <th class="p-3 border">Nomor Surat</th>
                            <th class="p-3 border">Tanggal</th>
                            <th class="p-3 border">Nama Pemohon</th>
                            <th class="p-3 border">Status</th>
                            <th class="p-3 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suratTugas as $surat_tugas)
                            <tr class="text-sm hover:bg-gray-50">
                                <td class="p-3 border text-center">{{ $loop->iteration }}</td>
                                <td class="p-3 border">{{ $surat_tugas->nomor_surat }}</td>
                                <td class="p-3 border">{{ \Carbon\Carbon::parse($surat_tugas->tanggal)->format('d-m-Y') }}</td>
                                <td class="p-3 border">{{ $surat_tugas->nama_pemohon }}</td>
                                <td class="p-3 border">
                                    @if($surat_tugas->status === 'pending')
                                        <span class="px-3 py-1 rounded-full bg-yellow-500 text-white text-xs">Pending</span>
                                    @elseif($surat_tugas->status === 'disetujui')
                                        <span class="px-3 py-1 rounded-full bg-green-500 text-white text-xs">Disetujui</span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-red-500 text-white text-xs">Revisi</span>
                                    @endif
                                </td>
                                <td class="p-3 border flex gap-2">
                                    <a href="{{ route('analis.surat_tugas.download', $surat_tugas->id) }}"
                                       class="px-3 py-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600">
                                        Download
                                    </a>
                                    <a href="{{ route('analis.surat_tugas.edit', $surat_tugas->id) }}"
                                       class="px-3 py-1 bg-yellow-500 text-white rounded text-xs hover:bg-yellow-600">
                                        Edit
                                    </a>
                                    <form action="{{ route('analis.surat_tugas.destroy', $surat_tugas->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="px-3 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-3 border text-center text-gray-500">Belum ada surat tugas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
