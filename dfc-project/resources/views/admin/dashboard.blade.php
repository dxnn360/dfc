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
                            <a href=""
                                class="text-white px-6 py-1 border-2 border-white rounded-full">Edit
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
                            <a href=""
                                class="text-white px-6 py-1 border-2 border-white rounded-full">Edit
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
                            <a href=""
                                class="text-white px-6 py-1 border-2 border-white rounded-full">Edit
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
                        <tr class="bg-[#979797] text-center text-white">
                            <td class="p-3">ID</td>
                            <td class="p-3">Username</td>
                            <td class="p-3">Role</td>
                            <td class="p-3">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $u)
                            <tr class=" bg-[#F3F3F3] text-center hover:bg-gray-100">
                                <td class="p-2">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                                </td>
                                <td class="p-2">{{ $u->name }}</td>
                                <td>{{ $u->roles->pluck('name')->implode(', ') }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $u) }}"
                                        class="px-4 mr-2 bg-[#00ABF1] font-medium rounded-full text-white">Edit</a>
                                    <form method="POST" action="{{ route('users.destroy', $u) }}" style="display:inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Yakin hapus user ini?')"
                                            class="px-4 mr-2 bg-[#FF0000] font-medium rounded-full text-white">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>


    </div>
    @push('scripts')
        @vite('resources/js/date.js')
    @endpush
</x-app-layout>