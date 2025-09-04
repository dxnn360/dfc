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
            <tr class="bg-[#4E5566] text-white text-center">
                <th class="p-2">No</th>
                <th class="p-2">Nomor Laporan</th>
                <th class="p-2">Nama Pemeriksa</th>
                <th class="p-2">Status</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-[#F3F3F3] hover:bg-gray-100 text-center">
                <td class="p-2">1</td>
                <td class="p-2">LP/001/2024</td>
                <td class="p-2">Andi Wijaya</td>
                <td class="p-2"><span class="px-3 py-1 rounded-full bg-green-500 text-white text-xs">Selesai</span></td>
                <td class="p-2 flex justify-center gap-2">
                    <button class="px-3 py-1 bg-[#00ABF1] text-white rounded-full text-sm">Edit</button>
                    <button class="px-3 py-1 bg-red-500 text-white rounded-full text-sm">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
