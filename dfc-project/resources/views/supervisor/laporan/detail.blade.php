<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Detail Laporan Pemeriksaan</h1>
                <p class="text-gray-600">Review dan verifikasi laporan pemeriksaan</p>
            </div>

            <div class="flex gap-6 flex-col lg:flex-row overflow-hidden">
                <!-- KIRI: Detail Laporan -->
                <div class="lg:w-1/2 space-y-6 flex-shrink-0">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <!-- Status Badge -->
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <span class="text-white font-semibold">Status Laporan</span>
                                <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-sm rounded-full">
                                    Pending Review
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6 space-y-6 max-h-[calc(70vh-80px)] overflow-y-auto overflow-x-hidden scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                            @php
                                $info = is_array($laporan->informasi_pemeriksaan) ? $laporan->informasi_pemeriksaan : json_decode($laporan->informasi_pemeriksaan, true) ?? [$laporan->informasi_pemeriksaan];
                                $metodologi = is_array($laporan->metodologi) ? $laporan->metodologi : json_decode($laporan->metodologi, true) ?? [$laporan->metodologi];
                                $sumber = is_array($laporan->sumber) ? $laporan->sumber : json_decode($laporan->sumber, true) ?? [$laporan->sumber];
                                $barangBukti = is_array($laporan->barang_bukti) ? $laporan->barang_bukti : json_decode($laporan->barang_bukti, true) ?? [$laporan->barang_bukti];
                            @endphp

                            <!-- Informasi Pemeriksaan -->
                            <div class="border-l-4 border-blue-500 pl-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Informasi Pemeriksaan
                                </h3>
                                <ul class="space-y-2">
                                    @foreach($info as $item)
                                        <li class="flex items-start">
                                            <span class="inline-block w-2 h-2 bg-blue-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                            <span class="text-gray-700 break-words">{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Data Pemohon -->
                            <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Data Pemohon
                                </h3>
                                <div class="grid grid-cols-1 gap-3">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Nama Pemohon</p>
                                        <p class="text-gray-900 font-medium break-words">{{ $laporan->nama_pemohon }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Unit Kerja</p>
                                        <p class="text-gray-900 font-medium break-words">{{ $laporan->jabatan_pemohon }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Tujuan Pemeriksaan -->
                            <div class="border-l-4 border-purple-500 pl-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    Tujuan Pemeriksaan
                                </h3>
                                <p class="text-gray-700 break-words whitespace-normal">{{ $laporan->tujuan_pemeriksaan }}</p>
                            </div>

                            <!-- Metodologi -->
                            <div class="border-l-4 border-green-500 pl-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                    </svg>
                                    Metodologi
                                </h3>
                                <ul class="space-y-2">
                                    @foreach($metodologi as $item)
                                        <li class="flex items-start">
                                            <span class="inline-block w-2 h-2 bg-green-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                            <span class="text-gray-700 break-words">{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Sumber -->
                            <div class="border-l-4 border-yellow-500 pl-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    Sumber
                                </h3>
                                <ul class="space-y-2">
                                    @foreach($sumber as $item)
                                        <li class="flex items-start">
                                            <span class="inline-block w-2 h-2 bg-yellow-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                            <span class="text-gray-700 break-words">
                                                @if(is_array($item))
                                                    {{ implode(', ', $item) }}
                                                @else
                                                    {{ $item }}
                                                @endif
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Barang Bukti -->
                            <div class="border-l-4 border-orange-500 pl-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    Barang Bukti
                                </h3>
                                <ul class="space-y-2">
                                    @foreach($barangBukti as $item)
                                        <li class="flex items-start">
                                            <span class="inline-block w-2 h-2 bg-orange-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                            <span class="text-gray-700 break-words">{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Kesimpulan -->
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-200">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Kesimpulan
                                </h3>
                                <p class="text-gray-700 leading-relaxed break-words overflow-wrap-anywhere word-break-break-word" style="word-wrap: break-word; overflow-wrap: break-word; word-break: break-word;">{{ $laporan->kesimpulan }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Tindakan</h3>
                        <div class="space-y-4">
                            <!-- Approve Form -->
                            <form action="{{ route('supervisor.laporan.approve', $laporan->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Approve Laporan
                                </button>
                            </form>

                            <!-- Reject Form -->
                            <form action="{{ route('supervisor.laporan.reject', $laporan->id) }}" method="POST" class="space-y-3">
                                @csrf
                                <textarea name="catatan_supervisor" rows="3" placeholder="Masukkan catatan penolakan..." class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent resize-none" required></textarea>
                                <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Reject Laporan
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
                        <iframe src="{{ route('supervisor.laporan.pdf', $laporan->id) }}" class="w-full h-[82vh] border-0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>