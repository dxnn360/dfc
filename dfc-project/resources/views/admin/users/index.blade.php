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

        <h1 class="text-4xl mt-8 mb-10 font-semibold">Halaman Pengguna</h1>

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

        <div>
            <div class="flex justify-between mb-4 mt-6">
                <div class="flex-0">
                    <h2 class="font-medium text-md">List Pengguna</h2>
                </div>
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
                </div></svg>
            </div>
            <table class="w-full border-collapse overflow-hidden rounded-xl">
                <tr class="bg-[#979797] text-white text-center font-regular">
                    <td class="p-2">No</td>
                    <td class="p-2">Nama</td>
                    <td>Email</td>
                    <td>Role</td>
                    <td>Aksi</td>
                </tr>
                @foreach($users as $u)
                    <tr class=" bg-[#F3F3F3] text-center hover:bg-gray-100">
                        <td class="p-2">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                        <td class="p-2">{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
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
            </table>

            {{ $users->links() }}

            <div class="flex justify-between mt-4">
                <div class="flex">
                    {{-- Navigation Info --}}
                    <div class="text-sm text-gray-600">
                        Menampilkan <span class="font-semibold">{{ $users->firstItem() }}</span> - <span
                            class="font-semibold">{{ $users->lastItem() }}</span>
                        dari <span class="font-semibold">{{ $users->total() }}</span> pengguna
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    {{-- Pagination --}}
                    <div class="inline-flex">
                        {{-- Previous Page Link --}}
                        @if ($users->onFirstPage())
                            <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded-l cursor-not-allowed"><</span>
                        @else
                            <a href="{{ $users->previousPageUrl() }}"
                                class="px-3 py-1 bg-[#00ABF1] text-white rounded-l hover:bg-[#0095c8]"><</a>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                            @if ($page == $users->currentPage())
                                <span class="px-3 py-1 bg-[#00ABF1] text-white">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}"
                                    class="px-3 py-1 bg-gray-200 text-gray-700 hover:bg-gray-300">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}"
                                class="px-3 py-1 bg-[#00ABF1] text-white rounded-r hover:bg-[#0095c8]">></a>
                        @else
                            <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded-r cursor-not-allowed">></span>
                        @endif
                    </div>
                    
                </div>
            </div>

            @push('scripts')
                @vite('resources/js/date.js')
            @endpush
        </div>

</x-app-layout>