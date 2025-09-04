<div class="overflow-x-auto">
    <div class="flex justify-between mb-6">
        <p class="text-md text-gray-800">Daftar Surat Tugas</p>
        <div class="flex-0 flex items-center space-x-2">
            <input type="text" placeholder="Tulis Nama Pengguna..."
                class="border border-gray-300 focus:border-[#00ABF1] rounded-full px-4 py-1 outline-none transition duration-150 w-64">
            <button
                class="bg-[#00ABF1] hover:bg-[#0095c8] text-white px-4 py-1 rounded-full flex items-center transition duration-150"
                type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                </svg>
                Cari
            </button>
        </div>
    </div>
    <table class="w-full border-collapse rounded-xl overflow-hidden">
        <thead>
            <tr class="bg-[#979797] text-white text-center">
                <td class="p-2">No</td>
                <td class="p-2">Nomor Laporan</td>
                <td class="p-2">Nama Pemeriksa</td>
                <td class="p-2">Status</td>
                <td class="p-2">Aksi</td>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-[#F3F3F3] hover:bg-gray-100 text-center">
                <td class="p-2">1</td>
                <td class="p-2">LP/001/2024</td>
                <td class="p-2">Andi Wijaya</td>
                <td class="p-2"><span class="px-3 py-1 rounded-full bg-green-500 text-white text-xs">Selesai</span></td>
                <td class="p-3 flex justify-center items-center">
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