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
            <h1 class="text-3xl font-semibold mb-3">Edit Surat Tugas Digital Baru</h1>
            <p class="text-sm">Silahkan isi data Surat Tugas sesuai dengan data yang ada!</p>
        </div>

        <!-- Form + Preview -->
        <div class="flex gap-6">
            <!-- Form -->
            <div class="flex-1 bg-white rounded-xl shadow-lg border p-8">
                <form id="surat-tugas-form">
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">Nama Ahli</p>
                        <input type="text" name="nama_ahli" class="rounded-full border-[#3C4B64] w-full">
                    </div>
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">Jabatan</p>
                        <input type="text" name="jabatan" class="rounded-full border-[#3C4B64] w-full">
                    </div>
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">NIP/NIK</p>
                        <input type="text" name="nip_nik" class="rounded-full border-[#3C4B64] w-full">
                    </div>
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">Nomor Surat</p>
                        <input type="text" name="nomor_surat" class="rounded-full border-[#3C4B64] w-full">
                    </div>
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">Tanggal</p>
                        <input type="date" name="tanggal" class="rounded-full border-[#3C4B64] w-full">
                    </div>
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">Sumber Permintaan</p>
                        <input type="text" name="sumber_permintaan" class="rounded-full border-[#3C4B64] w-full">
                    </div>
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">Ringkasan Kasus</p>
                        <textarea name="ringkasan_kasus" class="rounded-xl border-[#3C4B64] w-full"></textarea>
                    </div>

                    <!-- Button -->
                    <div class="flex justify-center">
                        <a href="{{ route('analis.dashboard') }}" 
                           class="bg-white text-[#C4C4C4] border-2 border-[#C4C4C4] px-8 rounded-full py-2 mt-2 font-bold mr-4 hover:text-gray-900 hover:bg-gray-400">
                           Batalkan
                        </a>
                        <button type="submit" 
                                class="bg-[#00ABF1] text-white px-8 rounded-full py-2 mt-2 font-bold hover:bg-blue-800">
                            Preview
                        </button>
                    </div>
                </form>
            </div>

            <!-- Preview -->
            <div class="flex-1">
                <div class="bg-gray-50 rounded-xl shadow-lg border p-8 h-full flex flex-col items-center justify-center">
                    <h2 class="text-lg font-semibold mb-4">Preview Surat Tugas (PDF)</h2>
                    <embed src="{{ asset('storage/dummy.pdf') }}" type="application/pdf" width="100%" height="600px" />
                    <p class="text-xs text-gray-400 mt-2">Preview dokumen PDF akan muncul di sini setelah klik Preview.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Dummy -->
    <script>
        document.getElementById('surat-tugas-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Pakai file dummy.pdf yang ditaruh di public/
            document.getElementById('pdf-preview').src = "storage/dummy.pdf";
        });
    </script>

    @push('scripts')
        @vite('resources/js/date.js')
    @endpush
</x-app-layout>
