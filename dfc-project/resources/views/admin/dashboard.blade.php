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

        <h1 class="text-4xl mt-8 mb-10 font-semibold">Dashboard Admin</h1>

        <div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="flex items-center bg-[#979797] px-4 py-6 rounded-2xl">
                    <div class="flex-shrink-0 mx-2">
                        <div class="bg-white rounded-3xl w-16 h-16 flex items-center justify-center">
                            <img src="images/Docs.png" alt="" class="w-8 h-8">
                        </div>
                    </div>
                    <div class="ml-4 text-white">
                        <p class="text-2xl">3</p>
                        <h3 class="text-xl font-semibold">Template</h3>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="flex items-center bg-[#979797] px-4 py-6 rounded-2xl">
                    <div class="flex-shrink-0 mx-2">
                        <div class="bg-white rounded-3xl w-16 h-16 flex items-center justify-center">
                            <img src="images/Users.png" alt="" class="w-8 h-8">
                        </div>
                    </div>
                    <div class="ml-4 text-white">
                        <p class="text-2xl">50</p>
                        <h3 class="text-xl font-semibold">Pengguna</h3>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="flex items-center bg-[#00ABF1] px-4 py-6 rounded-2xl">
                    <div class="flex-shrink-0 mx-2">
                        <div class="bg-white rounded-3xl w-16 h-16 flex items-center justify-center">
                            <img src="images/plus.png" alt="" class="w-8 h-8">
                        </div>
                    </div>
                    <div class="ml-4 text-white">
                        <h3 class="text-xl font-semibold">Tambah Pengguna</h3>
                    </div>
                </div>
            </div>

        </div>

        <div class="flex flex-col md:flex-row mt-6 gap-6">
            <!-- Bagian Template Dokumen -->
            <div class="flex-none w-full md:w-1/2">
                <h2 class="text-xl mb-4 font-medium">Template Dokumen</h2>
                <div class="grid grid-cols-1 gap-6">
                    <!-- Template Card 1 -->
                    <div class="bg-[#00ABF1] flex-row rounded-2xl shadow-md p-4">
                        <div class="flex mt-4 mb-8">
                            <div class="flex-shrink-0 mx-2">
                                <div class="bg-white rounded-3xl w-16 h-16 flex items-center justify-center">
                                    <img src="images/Docs.png" alt="" class="w-8 h-8">
                                </div>
                            </div>
                            <div class="ml-4 text-white">
                                <h3 class="text-2xl font-semibold">Surat Tugas Digital</h3>
                                <p class="text-md">Terakhir Diperbarui : 21 Agustus 2025</p>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <a href="#" class="text-white px-6 py-1 border-2 border-white rounded-full">Edit
                                Template</a>
                        </div>
                    </div>

                    <!-- Template Card 2 -->
                    <div class="bg-[#00ABF1] flex-row rounded-2xl shadow-md p-4">
                        <div class="flex mt-4 mb-8">
                            <div class="flex-shrink-0 mx-2">
                                <div class="bg-white rounded-3xl w-16 h-16 flex items-center justify-center">
                                    <img src="images/Docs.png" alt="" class="w-8 h-8">
                                </div>
                            </div>
                            <div class="ml-4 text-white">
                                <h3 class="text-2xl font-semibold">Surat Pengantar Digital</h3>
                                <p class="text-md">Terakhir Diperbarui : 21 Agustus 2025</p>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <a href="#" class="text-white px-6 py-1 border-2 border-white rounded-full">Edit
                                Template</a>
                        </div>
                    </div>

                    <!-- Template Card 3 -->
                    <div class="bg-[#00ABF1] flex-row rounded-2xl shadow-md p-4">
                        <div class="flex mt-4 mb-8">
                            <div class="flex-shrink-0 mx-2">
                                <div class="bg-white rounded-3xl w-16 h-16 flex items-center justify-center">
                                    <img src="images/Docs.png" alt="" class="w-8 h-8">
                                </div>
                            </div>
                            <div class="ml-4 text-white">
                                <h3 class="text-2xl font-semibold">Laporan Pemeriksaan</h3>
                                <p class="text-md">Terakhir Diperbarui : 21 Agustus 2025</p>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <a href="#" class="text-white px-6 py-1 border-2 border-white rounded-full">Edit
                                Template</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian Tabel -->
            <div class="flex-1 px-4 overflow-x-auto">
                <h2 class="text-lg mb-4 font-medium">Pengguna Terbaru</h2>
                <table class="w-full border-collapse overflow-hidden rounded-xl">
                    <thead>
                        <tr class="bg-[#979797] text-white">
                            <th class="p-3 text-left">ID</th>
                            <th class="p-3 text-left">Username</th>
                            <th class="p-3 text-left">Role</th>
                            <th class="p-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-[#F3F3F3] hover:bg-gray-100 transition">
                            <td class="p-3">1</td>
                            <td class="p-3">johndoe</td>
                            <td class="p-3">Admin</td>
                            <td class="p-3 flex gap-2">
                                <button
                                    class="px-3 py-1 text-sm bg-[#00ABF1] text-white rounded-full hover:bg-blue-600 transition">
                                    Edit
                                </button>
                                <button
                                    class="px-3 py-1 text-sm bg-red-500 text-white rounded-full hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-[#F3F3F3] hover:bg-gray-100 transition">
                            <td class="p-3">2</td>
                            <td class="p-3">janedoe</td>
                            <td class="p-3">Analis</td>
                            <td class="p-3 flex gap-2">
                                <button
                                    class="px-3 py-1 text-sm bg-[#00ABF1] text-white rounded-full hover:bg-blue-600 transition">
                                    Edit
                                </button>
                                <button
                                    class="px-3 py-1 text-sm bg-red-500 text-white rounded-full hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <tr class="bg-[#F3F3F3] hover:bg-gray-100 transition">
                            <td class="p-3">2</td>
                            <td class="p-3">janedoe</td>
                            <td class="p-3">Analis</td>
                            <td class="p-3 flex gap-2">
                                <button
                                    class="px-3 py-1 text-sm bg-[#00ABF1] text-white rounded-full hover:bg-blue-600 transition">
                                    Edit
                                </button>
                                <button
                                    class="px-3 py-1 text-sm bg-red-500 text-white rounded-full hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <tr class="bg-[#F3F3F3] hover:bg-gray-100 transition">
                            <td class="p-3">2</td>
                            <td class="p-3">janedoe</td>
                            <td class="p-3">Analis</td>
                            <td class="p-3 flex gap-2">
                                <button
                                    class="px-3 py-1 text-sm bg-[#00ABF1] text-white rounded-full hover:bg-blue-600 transition">
                                    Edit
                                </button>
                                <button
                                    class="px-3 py-1 text-sm bg-red-500 text-white rounded-full hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <tr class="bg-[#F3F3F3] hover:bg-gray-100 transition">
                            <td class="p-3">2</td>
                            <td class="p-3">janedoe</td>
                            <td class="p-3">Analis</td>
                            <td class="p-3 flex gap-2">
                                <button
                                    class="px-3 py-1 text-sm bg-[#00ABF1] text-white rounded-full hover:bg-blue-600 transition">
                                    Edit
                                </button>
                                <button
                                    class="px-3 py-1 text-sm bg-red-500 text-white rounded-full hover:bg-red-600 transition">
                                    Delete
                                </button>
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