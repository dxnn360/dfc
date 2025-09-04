<x-app-layout>
    <div class="mr-8">
        <div class="flex justify-between">
            <div class="flex-1">
                <h1 class="text-sm text-black">Hi, {{ auth()->user()->name }}👋</h1>
            </div>
            <div class="flex-1">
                <h1 class="text-sm text-black text-right" id="today"></h1>
            </div>
        </div>

        <h1 class="text-4xl mt-8 mb-10 font-semibold">Dashboard Supervisor</h1>

        <div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="flex items-center bg-[#979797] px-4 py-6 rounded-2xl">
                    <div class="flex-shrink-0 mx-2">
                        <div class="bg-white rounded-3xl w-16 h-16 flex items-center justify-center">
                            <img src="images/doc.png" alt="" class="w-8 h-8">
                        </div>
                    </div>
                    <div class="ml-4 text-white">
                        <p class="text-2xl">3</p>
                        <h3 class="text-xl font-semibold">Draft</h3>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="flex items-center bg-[#A2C1FF] px-4 py-6 rounded-2xl">
                    <div class="flex-shrink-0 mx-2">
                        <div class="bg-white rounded-3xl w-16 h-16 flex items-center justify-center">
                            <img src="images/process.png" alt="" class="w-8 h-8">
                        </div>
                    </div>
                    <div class="ml-4 text-white">
                        <p class="text-2xl">50</p>
                        <h3 class="text-xl font-semibold">Proses</h3>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="flex items-center bg-[#00E548] px-4 py-6 rounded-2xl">
                    <div class="flex-shrink-0 mx-2">
                        <div class="bg-white rounded-3xl w-16 h-16 flex items-center justify-center">
                            <img src="images/verify.png" alt="" class="w-8 h-8">
                        </div>
                    </div>
                    <div class="ml-4 text-white">
                        <p class="text-2xl">50</p>
                        <h3 class="text-xl font-semibold">Verification</h3>
                    </div>
                </div>
            </div>

        </div>

        <div class="flex flex-col mt-6 gap-6">

            <!-- Bagian Tabel -->
            <div class="flex-1 px-4 overflow-x-auto">
                <div class="flex justify-between items-center my-4">
                    <h2 class="text-lg font-medium">Surat Tugas Terbaru</h2>
                </div>
                <table class="w-full border-collapse overflow-hidden rounded-xl">
                    <thead>
                        <tr class="bg-[#979797] text-white">
                            <td class="p-3 text-center">No</td>
                            <td class="p-3 text-left">Nomor Surat</td>
                            <td class="p-3 text-left">Nama Pemohon</td>
                            <td class="p-3 text-left">Status</td>
                            <td class="p-3 text-left">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-[#F3F3F3] hover:bg-gray-100 transition">
                            <td class="p-3 text-center">1</td>
                            <td class="p-3">ST/001/2024</td>
                            <td class="p-3">Budi Santoso</td>
                            <td class="p-3">
                                <span class="px-3 py-1 rounded-full bg-[#979797] text-white text-xs">Draft</span>
                            </td>
                            <td class="p-3">
                                <a href="{{ route('supervisor.surattugas') }}">
                                    <button
                                        class="bg-[#00ABF1] px-4 py-1 rounded-full font-medium text-white flex items-center hover:bg-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Dokumen
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <tr class="bg-[#F3F3F3] hover:bg-gray-100 transition">
                            <td class="p-3 text-center">2</td>
                            <td class="p-3">ST/002/2024</td>
                            <td class="p-3">Siti Aminah</td>
                            <td class="p-3">
                                <span class="px-3 py-1 rounded-full bg-blue-400 text-white text-xs">Proses</span>
                            </td>
                            <td class="p-3">
                                <a href="{{ route('supervisor.surattugas') }}">
                                    <button
                                        class="bg-[#00ABF1] px-4 py-1 rounded-full font-medium text-white flex items-center hover:bg-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Dokumen
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <tr class="bg-[#F3F3F3] hover:bg-gray-100 transition">
                            <td class="p-3 text-center">3</td>
                            <td class="p-3">ST/003/2024</td>
                            <td class="p-3">Andi Wijaya</td>
                            <td class="p-3">
                                <span class="px-3 py-1 rounded-full bg-green-500 text-white text-xs">Selesai</span>
                            </td>
                            <td class="p-3">
                                <a href="{{ route('supervisor.surattugas') }}">
                                    <button
                                        class="bg-[#00ABF1] px-4 py-1 rounded-full font-medium text-white flex items-center hover:bg-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Dokumen
                                    </button>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex-1 px-4 overflow-x-auto">
                <div class="flex justify-between items-center my-4">
                    <h2 class="text-lg font-medium">Surat Pengantar Terbaru</h2>
                </div>
                <table class="w-full border-collapse overflow-hidden rounded-xl">
                    <thead>
                        <tr class="bg-[#979797] text-white">
                            <td class="p-3 text-center">No</td>
                            <td class="p-3 text-left">Nomor Surat</td>
                            <td class="p-3 text-left">Nama Pemohon</td>
                            <td class="p-3 text-left">Status</td>
                            <td class="p-3 text-left">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-[#F3F3F3] hover:bg-gray-100 transition">
                            <td class="p-3 text-center">1</td>
                            <td class="p-3">ST/001/2024</td>
                            <td class="p-3">Budi Santoso</td>
                            <td class="p-3">
                                <span class="px-3 py-1 rounded-full bg-[#979797] text-white text-xs">Draft</span>
                            </td>
                            <td class="p-3">
                                <a href="{{ route('supervisor.suratpengantar') }}">
                                    <button
                                        class="bg-[#00ABF1] px-4 py-1 rounded-full font-medium text-white flex items-center hover:bg-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Dokumen
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <tr class="bg-[#F3F3F3] hover:bg-gray-100 transition">
                            <td class="p-3 text-center">2</td>
                            <td class="p-3">ST/002/2024</td>
                            <td class="p-3">Siti Aminah</td>
                            <td class="p-3">
                                <span class="px-3 py-1 rounded-full bg-blue-400 text-white text-xs">Proses</span>
                            </td>
                            <td class="p-3">
                                <a href="{{ route('supervisor.suratpengantar') }}">
                                    <button
                                        class="bg-[#00ABF1] px-4 py-1 rounded-full font-medium text-white flex items-center hover:bg-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Dokumen
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <tr class="bg-[#F3F3F3] hover:bg-gray-100 transition">
                            <td class="p-3 text-center">3</td>
                            <td class="p-3">ST/003/2024</td>
                            <td class="p-3">Andi Wijaya</td>
                            <td class="p-3">
                                <span class="px-3 py-1 rounded-full bg-green-500 text-white text-xs">Selesai</span>
                            </td>
                            <td class="p-3">
                                <a href="{{ route('supervisor.suratpengantar') }}">
                                    <button
                                        class="bg-[#00ABF1] px-4 py-1 rounded-full font-medium text-white flex items-center hover:bg-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Dokumen
                                    </button>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex-1 px-4 overflow-x-auto">
                <div class="flex justify-between items-center my-4">
                    <h2 class="text-lg font-medium">Laporan Pemeriksaan Terbaru</h2>
                </div>
                <table class="w-full border-collapse overflow-hidden rounded-xl">
                    <thead>
                        <tr class="bg-[#979797] text-white">
                            <td class="p-3 text-center">No</td>
                            <td class="p-3 text-left">Nomor Surat</td>
                            <td class="p-3 text-left">Nama Pemohon</td>
                            <td class="p-3 text-left">Status</td>
                            <td class="p-3 text-left">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-[#F3F3F3] hover:bg-gray-100 transition">
                            <td class="p-3 text-center">1</td>
                            <td class="p-3">ST/001/2024</td>
                            <td class="p-3">Budi Santoso</td>
                            <td class="p-3">
                                <span class="px-3 py-1 rounded-full bg-[#979797] text-white text-xs">Draft</span>
                            </td>
                            <td class="p-3">
                                <a href="{{ route('supervisor.laporan') }}">
                                    <button
                                        class="bg-[#00ABF1] px-4 py-1 rounded-full font-medium text-white flex items-center hover:bg-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Dokumen
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <tr class="bg-[#F3F3F3] hover:bg-gray-100 transition">
                            <td class="p-3 text-center">2</td>
                            <td class="p-3">ST/002/2024</td>
                            <td class="p-3">Siti Aminah</td>
                            <td class="p-3">
                                <span class="px-3 py-1 rounded-full bg-blue-400 text-white text-xs">Proses</span>
                            </td>
                            <td class="p-3">
                                <a href="{{ route('supervisor.laporan') }}">
                                    <button
                                        class="bg-[#00ABF1] px-4 py-1 rounded-full font-medium text-white flex items-center hover:bg-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Dokumen
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <tr class="bg-[#F3F3F3] hover:bg-gray-100 transition">
                            <td class="p-3 text-center">3</td>
                            <td class="p-3">ST/003/2024</td>
                            <td class="p-3">Andi Wijaya</td>
                            <td class="p-3">
                                <span class="px-3 py-1 rounded-full bg-green-500 text-white text-xs">Selesai</span>
                            </td>
                            <td class="p-3">
                                <a href="{{ route('supervisor.laporan') }}">
                                    <button
                                        class="bg-[#00ABF1] px-4 py-1 rounded-full font-medium text-white flex items-center hover:bg-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Dokumen
                                    </button>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>


    </div>
    @push('scripts')
        @vite('resources/js/date.js')
    @endpush
</x-app-layout>