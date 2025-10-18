<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Detail Surat Pengantar</h1>
                <p class="text-gray-600">Review dan verifikasi surat pengantar</p>
            </div>

            <div class="flex gap-6 flex-col lg:flex-row overflow-hidden">
                <!-- KIRI: Detail Surat Pengantar -->
                <div class="lg:w-1/2 space-y-6 flex-shrink-0">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <!-- Status Badge -->
                        <div class="bg-gradient-to-r from-cyan-600 to-blue-600 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <span class="text-white font-semibold">Status Surat Pengantar</span>
                                <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-sm rounded-full">
                                    {{ ucfirst($surat->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6 space-y-6 max-h-[calc(70vh-80px)] overflow-y-auto overflow-x-hidden">
                            <!-- Informasi Surat -->
                            <div class="border-l-4 border-cyan-500 pl-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-cyan-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Informasi Surat
                                </h3>
                                <div class="space-y-3">
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <p class="text-sm text-gray-500 mb-1">Nomor Surat</p>
                                        <p class="text-gray-900 font-semibold break-words" style="word-wrap: break-word; overflow-wrap: break-word; word-break: break-word;">{{ $surat->nomor_surat }}</p>
                                    </div>
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <p class="text-sm text-gray-500 mb-1">Tanggal</p>
                                        <p class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($surat->tanggal)->format('d F Y') }}</p>
                                    </div>
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <p class="text-sm text-gray-500 mb-1">Klasifikasi</p>
                                        <p class="text-gray-900 font-medium break-words" style="word-wrap: break-word; overflow-wrap: break-word; word-break: break-word;">{{ $surat->klasifikasi }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Pemohon -->
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-200">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Data Pemohon
                                </h3>
                                <div class="grid grid-cols-1 gap-3">
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">Nama Pemohon</p>
                                        <p class="text-gray-900 font-semibold break-words" style="word-wrap: break-word; overflow-wrap: break-word; word-break: break-word;">{{ $surat->nama_pemohon }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">Jabatan Pemohon</p>
                                        <p class="text-gray-900 font-medium break-words" style="word-wrap: break-word; overflow-wrap: break-word; word-break: break-word;">{{ $surat->jabatan_pemohon }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Barang Bukti -->
                            <div class="border-l-4 border-orange-500 pl-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    Barang Bukti
                                </h3>
                                <div class="overflow-x-auto">
                                    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                                        <thead class="bg-gradient-to-r from-orange-500 to-amber-500">
                                            <tr>
                                                <th class="px-4 py-3 text-left text-sm font-semibold text-white border-b border-orange-400">No</th>
                                                <th class="px-4 py-3 text-left text-sm font-semibold text-white border-b border-orange-400">Deskripsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($surat->barang_bukti as $bb)
                                                <tr class="@if($loop->odd) bg-white @else bg-orange-50 @endif hover:bg-orange-100 transition-colors">
                                                    <td class="px-4 py-3 text-sm text-gray-700 border-b border-gray-200 align-top font-medium">{{ $loop->iteration }}</td>
                                                    <td class="px-4 py-3 text-sm text-gray-700 border-b border-gray-200 break-words" style="word-wrap: break-word; overflow-wrap: break-word; word-break: break-word;">
                                                        @if(is_array($bb) || is_object($bb))
                                                            {{ is_object($bb) ? json_encode($bb) : implode(', ', (array) $bb) }}
                                                        @else
                                                            {{ $bb }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="px-4 py-6 text-sm text-gray-500 text-center bg-gray-50">
                                                        <svg class="w-12 h-12 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                                        </svg>
                                                        Tidak ada barang bukti
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Status & Catatan -->
                            <div class="border-l-4 border-purple-500 pl-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                    Status & Catatan
                                </h3>
                                <div class="space-y-3">
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <p class="text-sm text-gray-500 mb-1">Status</p>
                                        <p class="text-gray-900 font-semibold">{{ ucfirst($surat->status) }}</p>
                                    </div>
                                    @if($surat->catatan_supervisor)
                                    <div class="bg-red-50 rounded-lg p-3 border border-red-200">
                                        <p class="text-sm text-red-600 mb-1 font-medium">Catatan Supervisor</p>
                                        <p class="text-gray-700 break-words" style="word-wrap: break-word; overflow-wrap: break-word; word-break: break-word;">{{ $surat->catatan_supervisor }}</p>
                                    </div>
                                    @else
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <p class="text-sm text-gray-500 mb-1">Catatan Supervisor</p>
                                        <p class="text-gray-400 italic">Tidak ada catatan</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Tindakan</h3>
                        <div class="space-y-4">
                            <!-- Approve Form -->
                            <form action="{{ route('supervisor.surat-pengantar.approve', $surat->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Approve Surat Pengantar
                                </button>
                            </form>

                            <!-- Reject Form -->
                            <form action="{{ route('supervisor.surat-pengantar.reject', $surat->id) }}" method="POST" class="space-y-3">
                                @csrf
                                <textarea name="catatan_supervisor" rows="3" placeholder="Masukkan catatan penolakan..." class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent resize-none" required></textarea>
                                <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Reject Surat Pengantar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- KANAN: PDF Preview -->
                <div class="lg:w-1/2 flex-shrink-0">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden lg:sticky lg:top-6">
                        <div class="bg-gradient-to-r from-gray-700 to-gray-800 px-6 py-4">
                            <h3 class="text-white font-semibold flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                Preview Dokumen PDF
                            </h3>
                        </div>
                        <iframe src="{{ route('supervisor.surat-pengantar.pdf', $surat->id) }}" class="w-full h-[82vh] border-0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>