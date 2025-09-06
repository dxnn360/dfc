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
            <h1 class="text-3xl font-semibold mb-3">Edit Surat Pengantar Digital Baru</h1>
            <p class="text-sm">Silahkan isi data Surat Pengantar sesuai dengan data yang ada!</p>
        </div>

        <!-- Form + Preview -->
        <div class="flex gap-6">
            <!-- Form -->
            <div class="flex-1 bg-white rounded-xl shadow-lg border p-8">
                <form id="surat-tugas-form">
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">Nomor Surat Pemeriksaan</p>
                        <input type="text" name="nomor_surat_pemeriksaan" class="rounded-full border-[#3C4B64] w-full">
                    </div>
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">Tanggal</p>
                        <input type="date" name="tanggal" class="rounded-full border-[#3C4B64] w-full">
                    </div>
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">Data Pemohon</p>
                        <input type="text" name="data_pemohon" class="rounded-full border-[#3C4B64] w-full">
                    </div>
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">Nomor Surat Permintaan</p>
                        <input type="text" name="nomor_surat_permintaan" class="rounded-full border-[#3C4B64] w-full">
                    </div>
                    <div class="mb-4">
                        <p class="mb-1 text-[#3C4B64]">Klasifikasi Surat</p>
                        <select name="klasifikasi_surat" class="rounded-full border-[#3C4B64] w-full">
                            <option value="">-- Pilih Klasifikasi --</option>
                            <option value="rahasia">Rahasia</option>
                            <option value="penting">Penting</option>
                            <option value="biasa">Biasa</option>
                        </select>
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
                            <!-- Dropdown pertama -->
                            <div class="flex items-center gap-2 mb-2">
                                <select name="barang_bukti[]" class="rounded-full border-[#3C4B64] w-full">
                                    <option value="">-- Pilih Barang Bukti --</option>
                                    <option value="dokumen">Dokumen</option>
                                    <option value="foto">Foto</option>
                                    <option value="rekaman">Rekaman</option>
                                    <option value="barang_fisik">Barang Fisik</option>
                                </select>
                            </div>
                        </div>
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
                <div class="bg-gray-50 rounded-xl shadow-lg border p-8 h-full flex flex-col items-center">
                    <h2 class="text-lg font-semibold mb-4">Preview Surat Pengantar (PDF)</h2>
                    <embed id="pdf-preview" src="{{ asset('storage/dummy.pdf') }}" type="application/pdf" width="100%" height="600px" />
                    <p class="text-xs text-gray-400 mt-2">Preview dokumen PDF akan muncul di sini setelah klik Preview.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Dynamic Barang Bukti -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const wrapper = document.getElementById('barang-bukti-wrapper');
            const addBtn = document.getElementById('add-bukti');

            addBtn.addEventListener('click', () => {
                const div = document.createElement('div');
                div.classList.add('flex', 'items-center', 'gap-2', 'mb-2');
                div.innerHTML = `
                    <input type="text" name="barang_bukti[]" placeholder="Masukkan barang bukti tambahan" 
                           class="rounded-full border-[#3C4B64] w-full">
                    <button type="button" class="remove-bukti bg-red-500 text-white rounded-full px-3">x</button>
                `;
                wrapper.appendChild(div);
            });

            wrapper.addEventListener('click', (e) => {
                if (e.target.classList.contains('remove-bukti')) {
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
