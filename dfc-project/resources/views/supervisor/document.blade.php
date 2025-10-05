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

            <!-- Dynamic Statistics Cards berdasarkan Tab Aktif -->
            <div x-data="{ activeTab: 'tugas' }" class="w-full">
                <!-- Cards Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Total Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span x-text="activeTab === 'tugas' ? 'Total Surat Tugas' : 
                                             activeTab === 'pengantar' ? 'Total Surat Pengantar' : 
                                             'Total Laporan'"></span>
                            </h3>
                            <div class="p-2 bg-gray-50 rounded-lg">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <p class="text-3xl font-bold text-gray-900 mb-2" 
                               x-text="activeTab === 'tugas' ? '{{ $suratTugas->count() }}' :
                                       activeTab === 'pengantar' ? '{{ $suratPengantar->count() }}' :
                                       '{{ $laporan->count() }}'">
                            </p>
                            <p class="text-sm text-gray-500">Semua Dokumen</p>
                        </div>
                    </div>

                    <!-- Approved Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Approved
                            </h3>
                            <div class="p-2 bg-green-50 rounded-lg">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <p class="text-3xl font-bold text-green-600 mb-2"
                               x-text="activeTab === 'tugas' ? '{{ $suratTugas->where('status', 'approved')->count() }}' :
                                       activeTab === 'pengantar' ? '{{ $suratPengantar->where('status', 'approved')->count() }}' :
                                       '{{ $laporan->where('status', 'approved')->count() }}'">
                            </p>
                            <p class="text-sm text-gray-500">Telah Disetujui</p>
                        </div>
                    </div>

                    <!-- Rejected Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Rejected
                            </h3>
                            <div class="p-2 bg-red-50 rounded-lg">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <p class="text-3xl font-bold text-red-600 mb-2"
                               x-text="activeTab === 'tugas' ? '{{ $suratTugas->where('status', 'rejected')->count() }}' :
                                       activeTab === 'pengantar' ? '{{ $suratPengantar->where('status', 'rejected')->count() }}' :
                                       '{{ $laporan->where('status', 'rejected')->count() }}'">
                            </p>
                            <p class="text-sm text-gray-500">Perlu Revisi</p>
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
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b border-gray-200">
                                <h2 class="text-xl font-semibold text-gray-900 flex items-center gap-3">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Daftar Surat Tugas
                                </h2>
                            </div>
                            <div>
                                <x-surat-tugas-table-spv :suratTugas="$suratTugas"/>
                            </div>
                        </div>
                    </div>

                    <!-- Surat Pengantar Tab -->
                    <div x-show="activeTab === 'pengantar'" x-transition:enter="transition ease-out duration-300" 
                         x-transition:enter-start="opacity-0 transform translate-y-4" 
                         x-transition:enter-end="opacity-100 transform translate-y-0">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-green-50 to-green-100 px-6 py-4 border-b border-gray-200">
                                <h2 class="text-xl font-semibold text-gray-900 flex items-center gap-3">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Daftar Surat Pengantar
                                </h2>
                            </div>
                            <div>
                                <x-surat-pengantar-table-spv :suratPengantar="$suratPengantar"/>
                            </div>
                        </div>
                    </div>

                    <!-- Laporan Pemeriksaan Tab -->
                    <div x-show="activeTab === 'laporan'" x-transition:enter="transition ease-out duration-300" 
                         x-transition:enter-start="opacity-0 transform translate-y-4" 
                         x-transition:enter-end="opacity-100 transform translate-y-0">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-purple-50 to-purple-100 px-6 py-4 border-b border-gray-200">
                                <h2 class="text-xl font-semibold text-gray-900 flex items-center gap-3">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Daftar Laporan Pemeriksaan
                                </h2>
                            </div>
                            <div>
                                <x-laporan-pemeriksaan-table-spv :laporan="$laporan"/>
                            </div>
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