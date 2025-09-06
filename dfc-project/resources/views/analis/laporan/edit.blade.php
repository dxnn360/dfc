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
            <h1 class="text-3xl font-semibold mb-3">Edit Laporan Forensik Baru</h1>
            <p class="text-sm">Silahkan isi data Laporan Forensik sesuai dengan data yang ada!</p>
        </div>

        <!-- Form + Preview -->
        <div class="flex gap-6">
            <!-- Form -->
            <div class="flex-1 bg-white rounded-xl shadow-lg border p-8">
                <form id="surat-tugas-form">
                    <!-- Informasi Pemeriksaan -->
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">Informasi Pemeriksaan</p>
                        <textarea name="informasi_pemeriksaan" class="rounded-xl border-[#3C4B64] w-full"></textarea>
                    </div>

                    <!-- Nama Pemohon -->
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">Nama Pemohon</p>
                        <input type="text" name="nama_pemohon" class="rounded-full border-[#3C4B64] w-full">
                    </div>

                    <!-- Unit Kerja Pemohon -->
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">Unit Kerja Pemohon</p>
                        <input type="text" name="unit_kerja" class="rounded-full border-[#3C4B64] w-full">
                    </div>

                    <!-- Barang Bukti -->
                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-[#3C4B64]">Barang Bukti</p>
                            <button type="button" id="add-bukti" class="text-sm bg-[#00ABF1] text-white px-3 py-1 rounded-full hover:bg-blue-700">
                                + Tambah
                            </button>
                        </div>
                        <div id="barang-bukti-wrapper">
                            <div class="flex items-center gap-2 mb-2">
                                <input type="text" name="barang_bukti[]" placeholder="Masukkan barang bukti" class="rounded-full border-[#3C4B64] w-full">
                            </div>
                        </div>
                    </div>

                    <!-- Tujuan Pemeriksaan -->
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">Tujuan Pemeriksaan</p>
                        <textarea name="tujuan_pemeriksaan" class="rounded-xl border-[#3C4B64] w-full"></textarea>
                    </div>

                    <!-- Metodologi -->
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">Metodologi</p>
                        <textarea name="metodologi" class="rounded-xl border-[#3C4B64] w-full"></textarea>
                    </div>

                    <!-- Sumber -->
                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-[#3C4B64]">Sumber</p>
                            <button type="button" id="add-sumber" class="text-sm bg-[#00ABF1] text-white px-3 py-1 rounded-full hover:bg-blue-700">
                                + Tambah
                            </button>
                        </div>
                        <div id="sumber-wrapper">
                            <div class="flex items-center gap-2 mb-2">
                                <input type="text" name="jenis_sumber[]" placeholder="Jenis Sumber" class="rounded-full border-[#3C4B64] w-1/3">
                                <input type="text" name="penjelasan_sumber[]" placeholder="Penjelasan Sumber" class="rounded-full border-[#3C4B64] w-2/3">
                            </div>
                        </div>
                    </div>

                    <!-- Hasil Pemeriksaan -->
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">Hasil Pemeriksaan</p>
                        <textarea name="hasil_pemeriksaan" class="rounded-xl border-[#3C4B64] w-full"></textarea>
                    </div>

                    <!-- Kesimpulan -->
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">Kesimpulan</p>
                        <textarea name="kesimpulan" class="rounded-xl border-[#3C4B64] w-full"></textarea>
                    </div>

                    <!-- Buttons -->
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
                <div class="bg-white rounded-xl shadow-lg border p-8 h-full flex flex-col items-center">
                    <h2 class="text-lg font-semibold mb-4">Preview Surat Pengantar (PDF)</h2>
                    <embed id="pdf-preview" src="{{ asset('storage/dummy.pdf') }}" type="application/pdf" width="100%" height="600px" />
                    <p class="text-xs text-gray-400 mt-2">Preview dokumen PDF akan muncul di sini setelah klik Preview.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Dynamic Fields -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Barang Bukti
            const buktiWrapper = document.getElementById('barang-bukti-wrapper');
            document.getElementById('add-bukti').addEventListener('click', () => {
                const div = document.createElement('div');
                div.classList.add('flex','items-center','gap-2','mb-2');
                div.innerHTML = `
                    <input type="text" name="barang_bukti[]" placeholder="Masukkan barang bukti" class="rounded-full border-[#3C4B64] w-full">
                    <button type="button" class="remove-bukti bg-red-500 text-white rounded-full px-3">x</button>
                `;
                buktiWrapper.appendChild(div);
            });
            buktiWrapper.addEventListener('click', (e) => {
                if (e.target.classList.contains('remove-bukti')) {
                    e.target.parentElement.remove();
                }
            });

            // Sumber
            const sumberWrapper = document.getElementById('sumber-wrapper');
            document.getElementById('add-sumber').addEventListener('click', () => {
                const div = document.createElement('div');
                div.classList.add('flex','items-center','gap-2','mb-2');
                div.innerHTML = `
                    <input type="text" name="jenis_sumber[]" placeholder="Jenis Sumber" class="rounded-full border-[#3C4B64] w-1/3">
                    <input type="text" name="penjelasan_sumber[]" placeholder="Penjelasan Sumber" class="rounded-full border-[#3C4B64] w-2/3">
                    <button type="button" class="remove-sumber bg-red-500 text-white rounded-full px-3">x</button>
                `;
                sumberWrapper.appendChild(div);
            });
            sumberWrapper.addEventListener('click', (e) => {
                if (e.target.classList.contains('remove-sumber')) {
                    e.target.parentElement.remove();
                }
            });

            // Dummy preview
            document.getElementById('surat-tugas-form').addEventListener('submit', function(e) {
                e.preventDefault();
                document.getElementById('pdf-preview').src = "{{ asset('storage/dummy.pdf') }}";
            });
        });
    </script>

    @push('scripts')
        @vite('resources/js/date.js')
    @endpush
</x-app-layout>
