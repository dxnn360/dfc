<div class="overflow-x-auto">
    <div class="flex justify-between mb-6">
        <p class="text-md text-gray-800 mt-2">Daftar Laporan Pemeriksaan</p>
        <div class="flex-0 flex items-center space-x-2">
            <input type="text" placeholder="Tulis Nama Pemohon..."
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
                <th class="p-2">Nomor Surat</th>
                <th class="p-2">Nama Pemohon</th>
                <th class="p-2">Tanggal Pengajuan</th>
                <th class="p-2">Status</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-[#F3F3F3] hover:bg-gray-100 text-center">
                <td class="p-2">1</td>
                <td class="p-2">ST/001/2025</td>
                <td class="p-2">Budi Santoso</td>
                <td class="p-2">05 Agustus 2025</td>
                <td class="p-2">
                    <span class="px-3 py-1 rounded-full bg-gray-500 text-white text-xs">Draft</span>
                </td>
                <td class="p-3 flex justify-center items-center">
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

            <tr class="bg-[#F3F3F3] hover:bg-gray-100 text-center">
                <td class="p-2">2</td>
                <td class="p-2">ST/002/2025</td>
                <td class="p-2">Park Jihye</td>
                <td class="p-2">06 Agustus 2025</td>
                <td class="p-2">
                    <span class="px-3 py-1 rounded-full bg-[#7AA6FF] text-white text-xs">Proses</span>
                </td>
                <td class="p-3 flex justify-center items-center">
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

            <tr class="bg-[#F3F3F3] hover:bg-gray-100 text-center">
                <td class="p-2">3</td>
                <td class="p-2">ST/022/2025</td>
                <td class="p-2">Lee Seokmin</td>
                <td class="p-2">08 Agustus 2025</td>
                <td class="p-2">
                    <span class="px-3 py-1 rounded-full bg-[#7AA6FF] text-white text-xs">Proses</span>
                </td>
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

    <div class="flex justify-end mt-4">
        <div class="flex items-center space-x-4">
            <div class="inline-flex">

                <!-- Previous Page -->
                <span
                    class="px-3 py-1 bg-white border border-[#C4C9D0] text-[#8A93A2] rounded-l cursor-not-allowed">&lt;</span>

                <!-- Page Numbers -->
                <span class="px-3 py-1 bg-[#00ABF1] border border-[#266AFD] text-white">1</span>
                <a href="#" class="px-3 py-1 bg-white border border-[#C4C9D0] text-[#8A93A2] hover:bg-gray-300">2</a>

                <!-- Next Page -->
                <a href="#"
                    class="px-3 py-1 bg-white border border-[#C4C9D0] text-[#8A93A2] rounded-r hover:bg-[#0095c8]">&gt;</a>
            </div>
        </div>

    </div>
</div>