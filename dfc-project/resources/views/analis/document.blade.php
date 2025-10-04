<x-app-layout>
    <div class="mr-8" x-data="{ tab: 'tugas' }">
        <!-- Header -->
        <div class="flex justify-between">
            <div class="flex-1">
                <h1 class="text-sm text-black">Hi, {{ auth()->user()->name }}👋</h1>
            </div>
            <div class="flex-1">
                <h1 class="text-sm text-black text-right" id="today"></h1>
            </div>
        </div>

        <!-- Tabs -->
        <div class="flex mt-6 border overflow-hidden">
            <template x-for="item in ['tugas','pengantar','laporan']" :key="item">
                <button 
                    @click="tab = item"
                    :class="tab === item 
                        ? 'bg-[#00ABF1] border border-[#450F86] text-white font-semibold' 
                        : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                    class="flex-1 px-4 py-3">
                    <span x-text="item === 'tugas' ? 'Surat Tugas' : (item === 'pengantar' ? 'Surat Pengantar' : 'Laporan Pemeriksaan')"></span>
                </button>
            </template>
        </div>

        <!-- Tab Content Wrapper -->
        <div class="relative mt-8">
            <!-- Surat Tugas -->
            <div x-show="tab === 'tugas'" class="w-full">
                <div class="flex justify-between mb-10">
                    <h1 class="text-3xl font-bold text-gray-800">Halaman Surat Tugas</h1>
                    <a href="#" class="bg-[#00ABF1] px-6 py-2 items-center rounded-full text-white shadow hover:bg-[#0095c8] transition">
                        <span class="text-xl">+</span> Tambah Surat Tugas
                    </a>
                </div>
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Proses Card -->
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-white bg-opacity-20 rounded-2xl w-16 h-16 flex items-center justify-center mr-4">
                                <img src="{{ asset('images/process.png') }}" alt="Proses" class="w-8 h-8">
                            </div>
                            <div>
                                <p class="text-3xl font-bold">{{ $stProsesCount ?? 0 }}</p>
                                <h3 class="text-lg font-semibold">Dalam Proses</h3>
                            </div>
                        </div>
                        <div class="mt-4 text-blue-100 text-sm">
                            Dokumen yang sedang diproses
                        </div>
                    </div>

                    <!-- Verification Card -->
                    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-white bg-opacity-20 rounded-2xl w-16 h-16 flex items-center justify-center mr-4">
                                <img src="{{ asset('images/verify.png') }}" alt="Verifikasi" class="w-8 h-8">
                            </div>
                            <div>
                                <p class="text-3xl font-bold">{{ $stCompletedCount ?? 0 }}</p>
                                <h3 class="text-lg font-semibold">Terverifikasi</h3>
                            </div>
                        </div>
                        <div class="mt-4 text-green-100 text-sm">
                            Dokumen yang sudah selesai
                        </div>
                    </div>

                    <!-- Revision Card -->
                    <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-white bg-opacity-20 rounded-2xl w-16 h-16 flex items-center justify-center mr-4">
                                <img src="{{ asset('images/doc.png') }}" alt="Revisi" class="w-8 h-8">
                            </div>
                            <div>
                                <p class="text-3xl font-bold">{{ $stRejectedCount ?? 0 }}</p>
                                <h3 class="text-lg font-semibold">Perlu Revisi</h3>
                            </div>
                        </div>
                        <div class="mt-4 text-red-100 text-sm">
                            Dokumen yang memerlukan perbaikan
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <x-surat-tugas-table :suratTugas="$suratTugas" />
                </div>
            </div>

            <!-- Surat Pengantar -->
            <div x-show="tab === 'pengantar'" class="w-full">
                <div class="flex justify-between mb-10">
                    <h1 class="text-3xl font-bold text-gray-800">Halaman Surat Pengantar</h1>
                    <a href="#" class="bg-[#00ABF1] px-6 py-2 items-center rounded-full text-white shadow hover:bg-[#0095c8] transition">
                        <span class="text-xl">+</span> Tambah Surat Pengantar
                    </a>
                </div>
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Proses Card -->
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-white bg-opacity-20 rounded-2xl w-16 h-16 flex items-center justify-center mr-4">
                                <img src="{{ asset('images/process.png') }}" alt="Proses" class="w-8 h-8">
                            </div>
                            <div>
                                <p class="text-3xl font-bold">{{ $srProsesCount ?? 0 }}</p>
                                <h3 class="text-lg font-semibold">Dalam Proses</h3>
                            </div>
                        </div>
                        <div class="mt-4 text-blue-100 text-sm">
                            Dokumen yang sedang diproses
                        </div>
                    </div>

                    <!-- Verification Card -->
                    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-white bg-opacity-20 rounded-2xl w-16 h-16 flex items-center justify-center mr-4">
                                <img src="{{ asset('images/verify.png') }}" alt="Verifikasi" class="w-8 h-8">
                            </div>
                            <div>
                                <p class="text-3xl font-bold">{{ $srCompletedCount ?? 0 }}</p>
                                <h3 class="text-lg font-semibold">Terverifikasi</h3>
                            </div>
                        </div>
                        <div class="mt-4 text-green-100 text-sm">
                            Dokumen yang sudah selesai
                        </div>
                    </div>

                    <!-- Revision Card -->
                    <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-white bg-opacity-20 rounded-2xl w-16 h-16 flex items-center justify-center mr-4">
                                <img src="{{ asset('images/doc.png') }}" alt="Revisi" class="w-8 h-8">
                            </div>
                            <div>
                                <p class="text-3xl font-bold">{{ $srRejectedCount ?? 0 }}</p>
                                <h3 class="text-lg font-semibold">Perlu Revisi</h3>
                            </div>
                        </div>
                        <div class="mt-4 text-red-100 text-sm">
                            Dokumen yang memerlukan perbaikan
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <x-surat-pengantar-table :suratPengantar="$suratPengantar" />
                </div>
            </div>

            <!-- Laporan Pemeriksaan -->
            <div x-show="tab === 'laporan'" class="w-full">
                <div class="flex justify-between mb-10">
                    <h1 class="text-3xl font-bold text-gray-800">Halaman Laporan Pemeriksaan</h1>
                    <a href="#" class="bg-[#00ABF1] px-6 py-2 items-center rounded-full text-white shadow hover:bg-[#0095c8] transition">
                        <span class="text-xl">+</span> Tambah Laporan Pemeriksaan
                    </a>
                </div>
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Proses Card -->
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-white bg-opacity-20 rounded-2xl w-16 h-16 flex items-center justify-center mr-4">
                                <img src="{{ asset('images/process.png') }}" alt="Proses" class="w-8 h-8">
                            </div>
                            <div>
                                <p class="text-3xl font-bold">{{ $lpProsesCount ?? 0 }}</p>
                                <h3 class="text-lg font-semibold">Dalam Proses</h3>
                            </div>
                        </div>
                        <div class="mt-4 text-blue-100 text-sm">
                            Dokumen yang sedang diproses
                        </div>
                    </div>

                    <!-- Verification Card -->
                    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-white bg-opacity-20 rounded-2xl w-16 h-16 flex items-center justify-center mr-4">
                                <img src="{{ asset('images/verify.png') }}" alt="Verifikasi" class="w-8 h-8">
                            </div>
                            <div>
                                <p class="text-3xl font-bold">{{ $lpCompletedCount ?? 0 }}</p>
                                <h3 class="text-lg font-semibold">Terverifikasi</h3>
                            </div>
                        </div>
                        <div class="mt-4 text-green-100 text-sm">
                            Dokumen yang sudah selesai
                        </div>
                    </div>

                    <!-- Revision Card -->
                    <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-white bg-opacity-20 rounded-2xl w-16 h-16 flex items-center justify-center mr-4">
                                <img src="{{ asset('images/doc.png') }}" alt="Revisi" class="w-8 h-8">
                            </div>
                            <div>
                                <p class="text-3xl font-bold">{{ $lpRejectedCount ?? 0 }}</p>
                                <h3 class="text-lg font-semibold">Perlu Revisi</h3>
                            </div>
                        </div>
                        <div class="mt-4 text-red-100 text-sm">
                            Dokumen yang memerlukan perbaikan
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <x-laporan-pemeriksaan-table :laporan="$laporan" />
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        @vite('resources/js/date.js')
    @endpush
</x-app-layout>
