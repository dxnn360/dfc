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
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="flex items-center bg-[#979797] px-4 py-6 rounded-2xl shadow">
                        <div class="bg-white rounded-3xl w-16 h-16 flex items-center justify-center shadow">
                            <img src="/images/doc.png" alt="" class="w-8 h-8">
                        </div>
                        <div class="ml-4 text-white">
                            <p class="text-2xl font-bold">3</p>
                            <h3 class="text-lg">Draft</h3>
                        </div>
                    </div>
                    <div class="flex items-center bg-[#A2C1FF] px-4 py-6 rounded-2xl shadow">
                        <div class="bg-white rounded-3xl w-16 h-16 flex items-center justify-center shadow">
                            <img src="/images/process.png" alt="" class="w-8 h-8">
                        </div>
                        <div class="ml-4 text-white">
                            <p class="text-2xl font-bold">10</p>
                            <h3 class="text-lg">Proses</h3>
                        </div>
                    </div>
                    <div class="flex items-center bg-[#00E548] px-4 py-6 rounded-2xl shadow">
                        <div class="bg-white rounded-3xl w-16 h-16 flex items-center justify-center shadow">
                            <img src="/images/verify.png" alt="" class="w-8 h-8">
                        </div>
                        <div class="ml-4 text-white">
                            <p class="text-2xl font-bold">5</p>
                            <h3 class="text-lg">Verification</h3>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <x-surat-tugas-table-spv />
                </div>
            </div>

            <!-- Surat Pengantar -->
            <div x-show="tab === 'pengantar'" class="w-full">
                <div class="flex justify-between mb-10">
                    <h1 class="text-3xl font-bold text-gray-800">Halaman Surat Pengantar</h1>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="flex items-center bg-[#979797] px-4 py-6 rounded-2xl shadow">
                        <div class="bg-white rounded-3xl w-16 h-16 flex items-center justify-center shadow">
                            <img src="/images/doc.png" alt="" class="w-8 h-8">
                        </div>
                        <div class="ml-4 text-white">
                            <p class="text-2xl font-bold">7</p>
                            <h3 class="text-lg">Draft</h3>
                        </div>
                    </div>
                    <div class="flex items-center bg-[#A2C1FF] px-4 py-6 rounded-2xl shadow">
                        <div class="bg-white rounded-3xl w-16 h-16 flex items-center justify-center shadow">
                            <img src="/images/process.png" alt="" class="w-8 h-8">
                        </div>
                        <div class="ml-4 text-white">
                            <p class="text-2xl font-bold">20</p>
                            <h3 class="text-lg">Proses</h3>
                        </div>
                    </div>
                    <div class="flex items-center bg-[#00E548] px-4 py-6 rounded-2xl shadow">
                        <div class="bg-white rounded-3xl w-16 h-16 flex items-center justify-center shadow">
                            <img src="/images/verify.png" alt="" class="w-8 h-8">
                        </div>
                        <div class="ml-4 text-white">
                            <p class="text-2xl font-bold">12</p>
                            <h3 class="text-lg">Verification</h3>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <x-surat-pengantar-table-spv />
                </div>
            </div>

            <!-- Laporan Pemeriksaan -->
            <div x-show="tab === 'laporan'" class="w-full">
                <div class="flex justify-between mb-10">
                    <h1 class="text-3xl font-bold text-gray-800">Halaman Laporan Pemeriksaan</h1>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="flex items-center bg-[#979797] px-4 py-6 rounded-2xl shadow">
                        <div class="bg-white rounded-3xl w-16 h-16 flex items-center justify-center shadow">
                            <img src="/images/doc.png" alt="" class="w-8 h-8">
                        </div>
                        <div class="ml-4 text-white">
                            <p class="text-2xl font-bold">2</p>
                            <h3 class="text-lg">Draft</h3>
                        </div>
                    </div>
                    <div class="flex items-center bg-[#A2C1FF] px-4 py-6 rounded-2xl shadow">
                        <div class="bg-white rounded-3xl w-16 h-16 flex items-center justify-center shadow">
                            <img src="/images/process.png" alt="" class="w-8 h-8">
                        </div>
                        <div class="ml-4 text-white">
                            <p class="text-2xl font-bold">15</p>
                            <h3 class="text-lg">Proses</h3>
                        </div>
                    </div>
                    <div class="flex items-center bg-[#00E548] px-4 py-6 rounded-2xl shadow">
                        <div class="bg-white rounded-3xl w-16 h-16 flex items-center justify-center shadow">
                            <img src="/images/verify.png" alt="" class="w-8 h-8">
                        </div>
                        <div class="ml-4 text-white">
                            <p class="text-2xl font-bold">8</p>
                            <h3 class="text-lg">Verification</h3>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <x-laporan-pemeriksaan-table-spv />
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        @vite('resources/js/date.js')
    @endpush
</x-app-layout>
