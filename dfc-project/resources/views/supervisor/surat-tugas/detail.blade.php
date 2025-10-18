<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Detail Surat Tugas</h1>
                <p class="text-gray-600">Review dan verifikasi surat tugas</p>
            </div>

            <div class="flex gap-6 flex-col lg:flex-row overflow-hidden">
                <!-- KIRI: Detail Surat Tugas -->
                <div class="lg:w-1/2 space-y-6 flex-shrink-0">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <!-- Status Badge -->
                        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <span class="text-white font-semibold">Status Surat Tugas</span>
                                <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-sm rounded-full">
                                    {{ ucfirst($surat->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6 space-y-6 max-h-[calc(70vh-80px)] overflow-y-auto overflow-x-hidden">
                            <!-- Informasi Dasar -->
                            <div class="border-l-4 border-indigo-500 pl-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Informasi Surat
                                </h3>
                                <div class="space-y-3">
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <p class="text-sm text-gray-500 mb-1">Nomor Surat</p>
                                        <p class="text-gray-900 font-semibold break-words">{{ $surat->nomor_surat }}</p>
                                    </div>
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <p class="text-sm text-gray-500 mb-1">Tanggal</p>
                                        <p class="text-gray-900 font-medium break-words">{{ $surat->tanggal }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Sumber Permintaan -->
                            <div class="border-l-4 border-blue-500 pl-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    Sumber Permintaan
                                </h3>
                                <p class="text-gray-700 break-words" style="word-wrap: break-word; overflow-wrap: break-word; word-break: break-word;">{{ $surat->sumber_permintaan }}</p>
                            </div>

                            <!-- Ringkasan Kasus -->
                            <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl p-4 border border-amber-200">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Ringkasan Kasus
                                </h3>
                                <p class="text-gray-700 leading-relaxed break-words" style="word-wrap: break-word; overflow-wrap: break-word; word-break: break-word;">{{ $surat->ringkasan_kasus }}</p>
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
                            <form action="{{ route('supervisor.surat-tugas.approve', $surat->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Approve Surat Tugas
                                </button>
                            </form>

                            <!-- Reject Form -->
                            <form action="{{ route('supervisor.surat-tugas.reject', $surat->id) }}" method="POST" class="space-y-3">
                                @csrf
                                <textarea name="catatan_supervisor" rows="3" placeholder="Masukkan catatan penolakan..." class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent resize-none" required></textarea>
                                <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Reject Surat Tugas
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
                        <iframe src="{{ route('supervisor.surat-tugas.pdf', $surat->id) }}" class="w-full h-[82vh] border-0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>