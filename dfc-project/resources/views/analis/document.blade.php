<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Dashboard Supervisor</h1>
                        <p class="mt-2 text-gray-600">Kelola dan tinjau dokumen yang memerlukan persetujuan</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border">
                            Hi, {{ auth()->user()->name }}👋
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs Navigation & Content -->
            <div x-data="{ activeTab: 'tugas' }" class="w-full">
                <!-- Dynamic Cards berdasarkan Tab Aktif -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Dalam Proses Card -->
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-white bg-opacity-20 rounded-2xl w-16 h-16 flex items-center justify-center mr-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-3xl font-bold" 
                                   x-text="activeTab === 'tugas' ? '{{ $stProsesCount ?? 0 }}' :
                                           activeTab === 'pengantar' ? '{{ $srProsesCount ?? 0 }}' :
                                           '{{ $lpProsesCount ?? 0 }}'">
                                </p>
                                <h3 class="text-lg font-semibold">Dalam Proses</h3>
                            </div>
                        </div>
                        <div class="mt-4 text-blue-100 text-sm">
                            <span x-text="activeTab === 'tugas' ? 'Surat Tugas yang sedang diproses' :
                                         activeTab === 'pengantar' ? 'Surat Pengantar yang sedang diproses' :
                                         'Laporan Pemeriksaan yang sedang diproses'"></span>
                        </div>
                    </div>

                    <!-- Terverifikasi Card -->
                    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-white bg-opacity-20 rounded-2xl w-16 h-16 flex items-center justify-center mr-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-3xl font-bold"
                                   x-text="activeTab === 'tugas' ? '{{ $stCompletedCount ?? 0 }}' :
                                           activeTab === 'pengantar' ? '{{ $srCompletedCount ?? 0 }}' :
                                           '{{ $lpCompletedCount ?? 0 }}'">
                                </p>
                                <h3 class="text-lg font-semibold">Terverifikasi</h3>
                            </div>
                        </div>
                        <div class="mt-4 text-green-100 text-sm">
                            <span x-text="activeTab === 'tugas' ? 'Surat Tugas yang sudah selesai' :
                                         activeTab === 'pengantar' ? 'Surat Pengantar yang sudah selesai' :
                                         'Laporan Pemeriksaan yang sudah selesai'"></span>
                        </div>
                    </div>

                    <!-- Perlu Revisi Card -->
                    <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-white bg-opacity-20 rounded-2xl w-16 h-16 flex items-center justify-center mr-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-3xl font-bold"
                                   x-text="activeTab === 'tugas' ? '{{ $stRejectedCount ?? 0 }}' :
                                           activeTab === 'pengantar' ? '{{ $srRejectedCount ?? 0 }}' :
                                           '{{ $lpRejectedCount ?? 0 }}'">
                                </p>
                                <h3 class="text-lg font-semibold">Perlu Revisi</h3>
                            </div>
                        </div>
                        <div class="mt-4 text-red-100 text-sm">
                            <span x-text="activeTab === 'tugas' ? 'Surat Tugas yang perlu perbaikan' :
                                         activeTab === 'pengantar' ? 'Surat Pengantar yang perlu perbaikan' :
                                         'Laporan Pemeriksaan yang perlu perbaikan'"></span>
                        </div>
                    </div>
                </div>

                <!-- Tabs Navigation -->
                <div class="mb-8">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8">
                            <!-- Surat Tugas Tab -->
                            <button 
                                @click="activeTab = 'tugas'"
                                :class="activeTab === 'tugas' 
                                    ? 'border-blue-500 text-blue-600 font-semibold' 
                                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 flex items-center gap-2">
                                <svg class="w-5 h-5" :class="activeTab === 'tugas' ? 'text-blue-500' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Surat Tugas
                                <span class="ml-2 py-0.5 px-2.5 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                    {{ $suratTugas->count() }}
                                </span>
                            </button>

                            <!-- Surat Pengantar Tab -->
                            <button 
                                @click="activeTab = 'pengantar'"
                                :class="activeTab === 'pengantar' 
                                    ? 'border-green-500 text-green-600 font-semibold' 
                                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 flex items-center gap-2">
                                <svg class="w-5 h-5" :class="activeTab === 'pengantar' ? 'text-green-500' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Surat Pengantar
                                <span class="ml-2 py-0.5 px-2.5 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                    {{ $suratPengantar->count() }}
                                </span>
                            </button>

                            <!-- Laporan Pemeriksaan Tab -->
                            <button 
                                @click="activeTab = 'laporan'"
                                :class="activeTab === 'laporan' 
                                    ? 'border-purple-500 text-purple-600 font-semibold' 
                                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 flex items-center gap-2">
                                <svg class="w-5 h-5" :class="activeTab === 'laporan' ? 'text-purple-500' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Laporan Pemeriksaan
                                <span class="ml-2 py-0.5 px-2.5 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                                    {{ $laporan->count() }}
                                </span>
                            </button>
                        </nav>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="w-full">
                    <!-- Surat Tugas Tab -->
                    <div x-show="activeTab === 'tugas'" x-transition:enter="transition ease-out duration-300" 
                         x-transition:enter-start="opacity-0 transform translate-y-4" 
                         x-transition:enter-end="opacity-100 transform translate-y-0">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-900">Daftar Surat Tugas</h2>
                            <a href="{{ route('analis.surat_tugas.create') }}" 
                               class="bg-[#00ABF1] px-6 py-3 flex items-center gap-2 rounded-full text-white shadow-lg hover:bg-[#0095c8] transition-all duration-200 font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Tambah Surat Tugas
                            </a>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <x-surat-tugas-table :suratTugas="$suratTugas"/>
                        </div>
                    </div>

                    <!-- Surat Pengantar Tab -->
                    <div x-show="activeTab === 'pengantar'" x-transition:enter="transition ease-out duration-300" 
                         x-transition:enter-start="opacity-0 transform translate-y-4" 
                         x-transition:enter-end="opacity-100 transform translate-y-0">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-900">Daftar Surat Pengantar</h2>
                            <a href="{{ route('analis.surat_pengantar.create') }}" 
                               class="bg-[#00ABF1] px-6 py-3 flex items-center gap-2 rounded-full text-white shadow-lg hover:bg-[#0095c8] transition-all duration-200 font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Tambah Surat Pengantar
                            </a>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <x-surat-pengantar-table :suratPengantar="$suratPengantar"/>
                        </div>
                    </div>

                    <!-- Laporan Pemeriksaan Tab -->
                    <div x-show="activeTab === 'laporan'" x-transition:enter="transition ease-out duration-300" 
                         x-transition:enter-start="opacity-0 transform translate-y-4" 
                         x-transition:enter-end="opacity-100 transform translate-y-0">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-900">Daftar Laporan Pemeriksaan</h2>
                            <a href="{{ route('analis.laporan.create') }}" 
                               class="bg-[#00ABF1] px-6 py-3 flex items-center gap-2 rounded-full text-white shadow-lg hover:bg-[#0095c8] transition-all duration-200 font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Tambah Laporan Pemeriksaan
                            </a>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <x-laporan-pemeriksaan-table :laporan="$laporan"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Set today's date in display
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const todayDisplay = new Date().toLocaleDateString('id-ID', options);
        });
    </script>
</x-app-layout>