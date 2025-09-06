<x-app-layout>
    <div class="mr-8">
        <!-- Header -->
        <div class="flex justify-between">
            <div class="flex-1">
                <h1 class="text-sm text-black">Hi, {{ auth()->user()->name }}👋</h1>
            </div>
            <div class="flex-1">
                <h1 class="text-sm text-black text-right" id="today"></h1>
            </div>
        </div>

        <!-- Title -->
        <div class="my-6">
            <h1 class="text-3xl font-semibold mb-3">Laporan Pemeriksaan Digital</h1>
            <p class="text-sm">Silahkan atur template laporan pemeriksaan anda di sini</p>
        </div>

        <!-- Form + Preview -->
        <div class="flex gap-6">
            <!-- Form -->
            <div class="flex-1">
                <div class="bg-white rounded-xl shadow-lg border p-8 flex flex-col h-full">
                    <form id="template-surat-form" class="flex flex-col flex-1">
                        <div class="flex-1">
                            <!-- Kop Surat -->
                            <div class="mb-4">
                                <p class="mb-1 text-[#3C4B64]">Kop Surat</p>
                                <label class="relative flex items-center w-full">
                                    <input type="file" name="kop_surat" class="hidden" id="kop_surat">
                                    <div
                                        class="h-11 w-full rounded-full border border-[#3C4B64] px-4 py-3 flex justify-between items-center cursor-pointer">
                                        <span id="kop_surat_name" class="text-gray-400 text-sm">Pilih file...</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#3C4B64]"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.586-6.586a4 4 0 10-5.656-5.656l-6.415 6.415" />
                                        </svg>
                                    </div>
                                </label>
                            </div>

                            <!-- Header -->
                            <div class="mb-4">
                                <p class="mb-1 text-[#3C4B64]">Header</p>
                                <label class="relative flex items-center w-full">
                                    <input type="file" name="header" class="hidden" id="header">
                                    <div
                                        class="h-11 w-full rounded-full border border-[#3C4B64] px-4 py-3 flex justify-between items-center cursor-pointer">
                                        <span id="header_name" class="text-gray-400 text-sm">Pilih file...</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#3C4B64]"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.586-6.586a4 4 0 10-5.656-5.656l-6.415 6.415" />
                                        </svg>
                                    </div>
                                </label>
                            </div>

                            <!-- Footer -->
                            <div class="mb-4">
                                <p class="mb-1 text-[#3C4B64]">Footer</p>
                                <label class="relative flex items-center w-full">
                                    <input type="file" name="footer" class="hidden" id="footer">
                                    <div
                                        class="h-11 w-full rounded-full border border-[#3C4B64] px-4 py-3 flex justify-between items-center cursor-pointer">
                                        <span id="footer_name" class="text-gray-400 text-sm">Pilih file...</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#3C4B64]"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.586-6.586a4 4 0 10-5.656-5.656l-6.415 6.415" />
                                        </svg>
                                    </div>
                                </label>
                            </div>

                            <!-- Format Tanggal -->
                            <div class="mb-4">
                                <p class="mb-1 text-[#3C4B64]">Format Tanggal</p>
                                <select name="format_tanggal"
                                    class="h-11 rounded-full border border-[#3C4B64] w-full px-4 py-3 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#00ABF1]">
                                    <option value="d/m/Y">04/09/2025</option>
                                    <option value="d-m-Y">04-09-2025</option>
                                    <option value="d F Y">04 September 2025</option>
                                    <option value="F d, Y">September 04, 2025</option>
                                </select>
                            </div>

                            <!-- Logo -->
                            <div class="mb-4">
                                <p class="mb-1 text-[#3C4B64]">Logo</p>
                                <label class="relative flex items-center w-full">
                                    <input type="file" name="logo" class="hidden" id="logo">
                                    <div
                                        class="h-11 w-full rounded-full border border-[#3C4B64] px-4 py-3 flex justify-between items-center cursor-pointer">
                                        <span id="logo_name" class="text-gray-400 text-sm">Pilih file...</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#3C4B64]"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.586-6.586a4 4 0 10-5.656-5.656l-6.415 6.415" />
                                        </svg>
                                    </div>
                                </label>
                            </div>
                        </div>


                        <div class="flex justify-center gap-4 mt-auto">
                            <a href="{{ route('admin.dashboard') }}"
                                class="bg-white text-[#C4C4C4] w-full text-center border-2 border-[#C4C4C4] px-8 rounded-full py-2 font-bold hover:text-gray-900 hover:bg-gray-400">
                                Batalkan
                            </a>
                            <button type="submit"
                                class="bg-[#00ABF1] text-white px-8 rounded-full py-2 font-bold hover:bg-blue-700 w-full">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Preview -->
            <div class="flex-1">
                <div class="bg-white rounded-xl shadow-lg border p-8 h-full flex flex-col items-center justify-center">
                    <div class="flex flex-row justify-between items-center mb-4 w-full">
                        <h2 class="text-lg font-semibold">Preview Dokumen</h2>
                        <a
                            href="{{ asset('storage/dummy.pdf') }}"
                            download
                            class="bg-[#00ABF1] px-4 py-1 rounded-full font-medium text-white flex items-center hover:bg-blue-700"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7V3a1 1 0 011-1h8a1 1 0 011 1v18a1 1 0 01-1 1H7a1 1 0 01-1-1V7z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h10M9 11h6M9 15h6" />
                            </svg>
                            Unduh Dokumen
                        </a>
                    </div>
                    <iframe src="{{ asset('storage/dummy.pdf') }}" type="application/pdf" width="100%" height="600px" />
                    <p class="text-xs text-gray-400 mt-2">Preview dokumen PDF akan muncul di sini.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Update nama file saat dipilih
        ['kop_surat', 'header', 'footer', 'logo'].forEach(id => {
            document.getElementById(id).addEventListener('change', function (e) {
                document.getElementById(id + '_name').textContent = e.target.files[0]?.name || 'Pilih file...';
            });
        });
    </script>

    @push('scripts')
        @vite('resources/js/date.js')
    @endpush
</x-app-layout>