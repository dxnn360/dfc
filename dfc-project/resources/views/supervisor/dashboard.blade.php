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
            <div x-show="tab === 'tugas'">
                <h1 class="text-2xl font-bold mb-6">Halaman Surat Tugas</h1>
                <x-surat-tugas-table-spv :suratTugas="$suratTugas" />
            </div>

            <!-- Surat Pengantar -->
            <div x-show="tab === 'pengantar'">
                <h1 class="text-2xl font-bold mb-6">Halaman Surat Pengantar</h1>
                <x-surat-pengantar-table-spv :suratPengantar="$suratPengantar" />
            </div>

            <!-- Laporan Pemeriksaan -->
            <div x-show="tab === 'laporan'">
                <h1 class="text-2xl font-bold mb-6">Halaman Laporan Pemeriksaan</h1>
                <x-laporan-pemeriksaan-table-spv :laporan="$laporan" />
            </div>
        </div>
    </div>
</x-app-layout>
