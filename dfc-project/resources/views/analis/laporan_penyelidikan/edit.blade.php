<x-app-layout>
    <!-- Summernote CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section with Status Badge -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Edit Laporan Penyelidikan</h1>
                            @if($laporan->status == 'draft')
                                <span
                                    class="px-3 py-1 bg-gray-100 text-gray-700 text-sm font-medium rounded-full border border-gray-300">
                                    📝 Draft
                                </span>
                            @elseif($laporan->status == 'pending')
                                <span
                                    class="px-3 py-1 bg-yellow-100 text-yellow-700 text-sm font-medium rounded-full border border-yellow-300">
                                    ⏳ Pending Review
                                </span>
                            @elseif($laporan->status == 'approved')
                                <span
                                    class="px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded-full border border-green-300">
                                    ✓ Disetujui
                                </span>
                            @elseif($laporan->status == 'rejected')
                                <span
                                    class="px-3 py-1 bg-red-100 text-red-700 text-sm font-medium rounded-full border border-red-300">
                                    ✗ Ditolak
                                </span>
                            @endif
                        </div>
                        <p class="mt-2 text-gray-600">Edit dan kelola laporan penyelidikan Anda</p>
                        @if($laporan->status == 'rejected' && $laporan->rejection_reason)
                            <div class="mt-3 p-3 bg-red-50 border border-red-200 rounded-lg">
                                <p class="text-sm font-medium text-red-800">Alasan Penolakan:</p>
                                <p class="text-sm text-red-700 mt-1">{{ $laporan->rejection_reason }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <div id="today" class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            @if($laporan->status == 'draft' || $laporan->status == 'rejected')
                <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-blue-800">
                                Laporan ini berstatus
                                <strong>{{ $laporan->status == 'draft' ? 'Draft' : 'Ditolak' }}</strong>
                            </p>
                            <p class="text-sm text-blue-700 mt-1">
                                Anda dapat mengedit laporan dan mengajukan review ke supervisor untuk disetujui.
                            </p>
                        </div>
                    </div>
                </div>
            @elseif($laporan->status == 'pending')
                <div class="mb-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-yellow-800">
                                Laporan sedang dalam proses review
                            </p>
                            <p class="text-sm text-yellow-700 mt-1">
                                Laporan Anda sedang ditinjau oleh supervisor. Anda tidak dapat mengedit laporan saat ini.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('analis.laporan.update', $laporan->id) }}" method="POST" id="laporan-form"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="action" id="form-action" value="save_draft">

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                    <!-- Form Section -->
                    <div class="space-y-6">
                        <!-- Basic Information Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <div class="w-2 h-6 bg-blue-600 rounded-full"></div>
                                Informasi Umum
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Surat</label>
                                    <input type="text" value="{{ $laporan->nomor_surat }}" name="nomor_surat"
                                        id="nomor_surat"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-50 text-gray-600 focus:outline-none"
                                        readonly>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" value="{{ $laporan->tanggal }}"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors"
                                        {{ $laporan->status == 'pending' || $laporan->status == 'approved' ? 'disabled' : '' }}>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pemohon</label>
                                    <input type="text" name="nama_pemohon" id="nama_pemohon"
                                        value="{{ $laporan->nama_pemohon }}"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors"
                                        {{ $laporan->status == 'pending' || $laporan->status == 'approved' ? 'disabled' : '' }}>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Unit Kerja
                                        Pemohon</label>
                                    <input type="text" name="jabatan_pemohon" id="jabatan_pemohon"
                                        value="{{ $laporan->jabatan_pemohon }}"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors"
                                        {{ $laporan->status == 'pending' || $laporan->status == 'approved' ? 'disabled' : '' }}>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" id="pekerjaan" value="{{ $laporan->pekerjaan }}"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors"
                                        {{ $laporan->status == 'pending' || $laporan->status == 'approved' ? 'disabled' : '' }}>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Instansi Pemohon</label>
                                    <input type="text" name="organisasi" id="organisasi"
                                        value="{{ $laporan->organisasi }}"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors"
                                        {{ $laporan->status == 'pending' || $laporan->status == 'approved' ? 'disabled' : '' }}>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Sumber
                                        Permintaan</label>
                                    <input type="text" name="sumber_permintaan" id="sumber_permintaan"
                                        value="{{ $laporan->sumber_permintaan }}"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors"
                                        {{ $laporan->status == 'pending' || $laporan->status == 'approved' ? 'disabled' : '' }}>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                    <input type="text" name="no_telp" id="no_telp" value="{{ $laporan->no_telp }}"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors"
                                        {{ $laporan->status == 'pending' || $laporan->status == 'approved' ? 'disabled' : '' }}>
                                </div>
                            </div>
                        </div>

                        <!-- Investigation Details Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <div class="w-2 h-6 bg-green-600 rounded-full"></div>
                                Detail Penyelidikan
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Informasi
                                        Pemeriksaan</label>
                                    <textarea name="informasi_pemeriksaan"
                                        id="informasi_pemeriksaan">{{ $laporan->informasi_pemeriksaan }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tujuan
                                        Pemeriksaan</label>
                                    <textarea name="tujuan_pemeriksaan"
                                        id="tujuan_pemeriksaan">{{ $laporan->tujuan_pemeriksaan }}</textarea>
                                </div>

                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                        <div class="w-2 h-6 bg-green-600 rounded-full"></div>
                                        Metodologi
                                    </h3>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Metodologi</label>
                                        <input type="text" name="metodologi" id="metodologi"
                                            placeholder="Isi metodologi di sini..."
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-200 transition-colors"
                                            value="{{ old('metodologi', $laporan->metodologi ?? '') }}">
                                        <p class="text-xs text-gray-500">
                                            Contoh: "Analisis Digital Forensik Standar menggunakan tools forensik
                                            digital seperti FTK Imager, Autopsy, dan Wireshark"
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Evidence Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <div class="w-2 h-6 bg-purple-600 rounded-full"></div>
                                Barang Bukti
                            </h3>
                            <div id="barang-bukti-section">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Barang
                                    Bukti</label>
                                <textarea name="barang_bukti" id="barang_bukti">{{ $laporan->barang_bukti }}</textarea>
                            </div>
                        </div>

                        <!-- Sources Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <div class="w-2 h-6 bg-orange-600 rounded-full"></div>
                                Sumber Informasi
                            </h3>
                            <div id="sumber-section">
                                <div id="sumber-wrapper" class="space-y-3 mb-4">
                                    @if($laporan->sumber && count($laporan->sumber) > 0)
                                        @foreach($laporan->sumber as $sumber)
                                            <div class="flex gap-3">
                                                <input type="text" name="jenis_sumber[]" value="{{ $sumber['jenis'] ?? '' }}"
                                                    placeholder="Jenis Sumber"
                                                    class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors"
                                                    {{ $laporan->status == 'pending' || $laporan->status == 'approved' ? 'disabled' : '' }}>
                                                <input type="text" name="penjelasan_sumber[]"
                                                    value="{{ $sumber['penjelasan'] ?? '' }}" placeholder="Penjelasan"
                                                    class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors"
                                                    {{ $laporan->status == 'pending' || $laporan->status == 'approved' ? 'disabled' : '' }}>
                                                @if($laporan->status != 'pending' && $laporan->status != 'approved')
                                                    <button type="button"
                                                        class="px-3 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors remove-sumber">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="flex gap-3">
                                            <input type="text" name="jenis_sumber[]" placeholder="Jenis Sumber"
                                                class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                                            <input type="text" name="penjelasan_sumber[]" placeholder="Penjelasan"
                                                class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                                        </div>
                                    @endif
                                </div>
                                @if($laporan->status != 'pending' && $laporan->status != 'approved')
                                    <button type="button" id="add-sumber"
                                        class="flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        Tambah Sumber
                                    </button>
                                @endif
                            </div>
                        </div>

                        <!-- Results Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <div class="w-2 h-6 bg-red-600 rounded-full"></div>
                                Hasil & Kesimpulan
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Hasil
                                        Pemeriksaan</label>
                                    <textarea name="hasil_pemeriksaan"
                                        id="hasil_pemeriksaan">{{ $laporan->hasil_pemeriksaan }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kesimpulan</label>
                                    <textarea name="kesimpulan" id="kesimpulan">{{ $laporan->kesimpulan }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        @if($laporan->status == 'draft' || $laporan->status == 'rejected')
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Action Buttons -->
                                <div class="flex gap-3 pt-6">
                                    <a href="{{ route('analis.document') }}"
                                        class="flex-1 border-2 border-gray-500 text-gray-500 font-semibold py-3 px-6 rounded-xl hover:bg-gray-600 transition-all duration-200 shadow-lg hover:shadow-xl text-center">
                                        Batal
                                    </a>
                                    <button type="submit"
                                        class="flex-1 bg-white border-2 border-blue-500 text-blue-500 font-semibold py-3 px-6 rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                        <div class="flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Update Laporan
                                        </div>
                                    </button>
                                </div>

                                <div class="flex pt-2">
                                    <button type="submit" name="status" value="pending"
                                        class="flex-1 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold py-3 px-6 rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                        <div class="flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Ajukan untuk Review
                                        </div>
                                    </button>
                                </div>
                            </div>
                        @elseif($laporan->status == 'pending')
                            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 text-center">
                                <svg class="w-12 h-12 text-yellow-600 mx-auto mb-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-yellow-800 font-medium">Laporan sedang dalam proses review</p>
                                <p class="text-yellow-700 text-sm mt-1">Menunggu persetujuan dari supervisor</p>
                            </div>
                        @elseif($laporan->status == 'approved')
                            <div class="bg-green-50 border border-green-200 rounded-xl p-6 text-center">
                                <svg class="w-12 h-12 text-green-600 mx-auto mb-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-green-800 font-medium">Laporan telah disetujui</p>
                                <p class="text-green-700 text-sm mt-1">Laporan ini sudah final dan tidak dapat diubah</p>
                            </div>
                        @endif
                    </div>

                    <!-- Preview Section -->
                    <div class="space-y-6">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-8">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Preview Dokumen
                                </h2>
                                <div class="flex items-center gap-2 text-sm text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Update Real-time</span>
                                </div>
                            </div>

                            <div id="preview-container"
                                class="border-2 border-gray-200 rounded-lg bg-gray-50 overflow-auto">
                                <div id="preview-area" class="p-4">
                                    <div class="text-center text-gray-500 py-20" style="width: 210mm;">
                                        <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p>Preview akan muncul di sini</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between items-center mt-2 text-xs text-gray-500">
                                <span>← Scroll untuk melihat seluruh dokumen →</span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                    </svg>
                                    Geser untuk melihat
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmation-modal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-center w-12 h-12 mx-auto bg-green-100 rounded-full mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Ajukan Review?</h3>
                <p class="text-gray-600 text-center mb-6">
                    Laporan akan dikirim ke supervisor untuk ditinjau. Anda tidak dapat mengedit laporan setelah
                    pengajuan. Pastikan semua data sudah benar.
                </p>
                <div class="flex gap-3">
                    <button type="button" id="cancel-submit"
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" id="confirm-submit" name="status" value="pending"
                        class="flex-1 px-4 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                        Ya, Ajukan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        #preview-container {
            height: 800px;
            overflow: auto;
            background: #f8f9fa;
            position: relative;
        }

        .preview-content {
            width: 210mm;
            min-height: 297mm;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            margin: 0 auto;
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            line-height: 1.6;
            overflow-wrap: break-word;
            word-wrap: break-word;
        }

        .a4-page {
            width: 100%;
            min-height: 297mm;
            padding: 20mm;
            display: flex;
            flex-direction: column;
        }

        .a4-header,
        .a4-footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .a4-body {
            margin: 20px 0;
            flex: 1;
        }

        .preview-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 11pt;
            table-layout: fixed;
        }

        .preview-table th,
        .preview-table td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .preview-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .preview-table .number-col {
            width: 50px;
            text-align: center;
        }

        .preview-table .jenis-col {
            width: 30%;
        }

        .preview-table .penjelasan-col {
            width: auto;
        }

        .section-title {
            font-size: 14pt;
            font-weight: bold;
            margin: 20px 0 10px 0;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
        }

        .content-paragraph {
            margin-bottom: 15px;
            text-align: justify;
            text-indent: 1.5em;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        #preview-container::-webkit-scrollbar {
            width: 12px;
            height: 12px;
        }

        #preview-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 6px;
        }

        #preview-container::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 6px;
            border: 2px solid #f1f1f1;
        }

        #preview-container::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        .note-editor {
            border: 1px solid #d1d5db !important;
            border-radius: 0.5rem !important;
        }

        .note-editor.note-frame {
            border-color: #d1d5db !important;
        }

        .note-editor:focus-within {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2) !important;
        }

        .metodologi-option.selected {
            border-color: #3b82f6 !important;
            background-color: #eff6ff !important;
        }

        @media print {
            .a4-page {
                box-shadow: none;
                margin: 0;
                page-break-after: always;
            }

            .a4-page:last-child {
                page-break-after: auto;
            }

            .preview-content {
                transform: none;
                margin: 0;
            }
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function () {
            const laporanStatus = '{{ $laporan->status }}';
            const isEditable = laporanStatus === 'draft' || laporanStatus === 'rejected';

            // Set today's date display
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const todayDisplay = new Date().toLocaleDateString('id-ID', options);
            $('#today').text(todayDisplay);

            const TEMPLATE = @json([
                'header' => $template->header ?? '<div style="text-align:center;"><h3>INSTANSI</h3><p>LAPORAN PENYELIDIKAN</p></div>',
                'body' => $template->body ?? '<div class="section-title">I. INFORMASI UMUM</div><p>Template body belum diatur</p>',
                'footer' => $template->footer ?? '<p style="text-align:center;">Footer template</p>'
            ]);

            // Initialize Summernote
            const summernoteConfig = {
                height: 200,
                toolbar: isEditable ? [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ] : [],
                disabled: !isEditable,
                callbacks: {
                    onChange: function (contents) {
                        updatePreview();
                    },
                    onImageUpload: function (files) {
                        if (isEditable) {
                            for (let i = 0; i < files.length; i++) {
                                uploadImage(files[i], $(this));
                            }
                        }
                    }
                }
            };

            $('#informasi_pemeriksaan').summernote(summernoteConfig);
            $('#tujuan_pemeriksaan').summernote(summernoteConfig);
            $('#barang_bukti').summernote(summernoteConfig);
            $('#hasil_pemeriksaan').summernote(summernoteConfig);
            $('#kesimpulan').summernote(summernoteConfig);

            function uploadImage(file, editor) {
                const data = new FormData();
                data.append("file", file);

                $.ajax({
                    url: 'upload-image',
                    type: 'POST',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        editor.summernote('insertImage', res.url);
                    },
                    error: function (err) {
                        alert('Gagal upload image');
                        console.error(err);
                    }
                });
            }

            function formatDateToLong(dateString) {
                if (!dateString) return '';
                const d = new Date(dateString);
                return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
            }

            function replacePlaceholders(html, key, val) {
                if (!html) return '';
                const patterns = [
                    new RegExp(`\\{\\{\\s*${key}\\s*\\}\\}`, 'gi'),
                    new RegExp(`\\[\\s*${key.toUpperCase()}\\s*\\]`, 'g')
                ];
                let result = html;
                patterns.forEach(pattern => result = result.replace(pattern, val));
                return result;
            }

            function buildBarangBuktiTable() {
                const content = $('#barang_bukti').summernote('code');
                if (!content || content.trim() === '' || content === '<p><br></p>') {
                    return '<p class="content-paragraph">Tidak ada barang bukti</p>';
                }
                return content;
            }

            function buildSumberTable() {
                const jenis = $('[name="jenis_sumber[]"]');
                const penjelasan = $('[name="penjelasan_sumber[]"]');
                let rows = '';
                let counter = 1;
                let hasItems = false;

                for (let i = 0; i < jenis.length; i++) {
                    if ($(jenis[i]).val().trim() || $(penjelasan[i]).val().trim()) {
                        rows += `<tr>
                            <td class="number-col">${counter}</td>
                            <td class="jenis-col">${$(jenis[i]).val().replace(/</g, '&lt;').replace(/>/g, '&gt;')}</td>
                            <td class="penjelasan-col">${$(penjelasan[i]).val().replace(/</g, '&lt;').replace(/>/g, '&gt;')}</td>
                        </tr>`;
                        counter++;
                        hasItems = true;
                    }
                }

                if (!hasItems) return '<p class="content-paragraph">Tidak ada sumber</p>';

                return `<table class="preview-table">
                    <thead>
                        <tr>
                            <th class="number-col">No</th>
                            <th class="jenis-col">Jenis Sumber</th>
                            <th class="penjelasan-col">Penjelasan</th>
                        </tr>
                    </thead>
                    <tbody>${rows}</tbody>
                </table>`;
            }

            function getSelectedMetodologi() {
                const selectedOption = $('input[name="metodologi_option"]:checked');
                if (selectedOption.length === 0) return 'Belum dipilih';

                const option = selectedOption.val();
                const valueInput = $(`[name="metodologi_${option}_value"]`);

                if (valueInput.length > 0) {
                    const value = valueInput.val().trim();
                    if (value) return value;

                    switch (option) {
                        case 'a':
                            return 'Analisis Digital Forensik Standar menggunakan tools forensik digital seperti FTK Imager, Autopsy, dan Wireshark';
                        case 'b':
                            return 'Investigasi Lanjutan termasuk analisis memori, network traffic, dan timeline analysis';
                        case 'custom':
                            return 'Metodologi kustom yang disesuaikan dengan kebutuhan investigasi';
                        default:
                            return 'Metodologi belum ditentukan';
                    }
                }

                return 'Metodologi belum dipilih';
            }

            function updatePreview() {
                let header = TEMPLATE.header;
                let body = TEMPLATE.body;
                let footer = TEMPLATE.footer;

                const data = {
                    nomor_surat: $('#nomor_surat').val() || 'NOMOR/BELUM/TERISI',
                    tanggal: formatDateToLong($('#tanggal').val()) || '',
                    nama_pemohon: $('#nama_pemohon').val() || '-',
                    jabatan_pemohon: $('#jabatan_pemohon').val() || '-',
                    info: $('#informasi_pemeriksaan').summernote('code') || 'Belum diisi',
                    barang_bukti: buildBarangBuktiTable(),
                    tujuan: $('#tujuan_pemeriksaan').summernote('code') || 'Belum diisi',
                    metodologi: $('#metodologi').val().trim() || 'Metodologi belum ditentukan',
                    sumber: buildSumberTable(),
                    hasil: $('#hasil_pemeriksaan').summernote('code') || 'Belum diisi',
                    kesimpulan: $('#kesimpulan').summernote('code') || 'Belum diisi'
                };

                Object.keys(data).forEach(key => {
                    header = replacePlaceholders(header, key, data[key]);
                    body = replacePlaceholders(body, key, data[key]);
                    footer = replacePlaceholders(footer, key, data[key]);
                });

                $('#preview-area').html(`
                    <div class="preview-content">
                        <div class="a4-page">
                            <div class="a4-header">${header}</div>
                            <div class="a4-body">${body}</div>
                            <div class="a4-footer">${footer}</div>
                        </div>
                    </div>
                `);
            }

            // Event listeners
            if (isEditable) {
                $('#nomor_surat, #tanggal, #nama_pemohon, #jabatan_pemohon').on('input change', updatePreview);

                $('input[name="metodologi_option"]').on('change', function () {
                    $('.metodologi-option').removeClass('selected');
                    $(this).closest('.metodologi-option').addClass('selected');
                    updatePreview();
                });

                $('.metodologi-input').on('input', updatePreview);

                $('#add-sumber').on('click', function () {
                    const wrapper = $('#sumber-wrapper');
                    const div = $('<div class="flex gap-3"></div>');
                    div.html(`
                        <input type="text" name="jenis_sumber[]" placeholder="Jenis Sumber" 
                               class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                        <input type="text" name="penjelasan_sumber[]" placeholder="Penjelasan" 
                               class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                        <button type="button" class="px-3 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors remove-sumber">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    `);
                    wrapper.append(div);
                    div.find('input').on('input', updatePreview);
                });

                $(document).on('click', '.remove-sumber', function () {
                    $(this).closest('.flex').remove();
                    updatePreview();
                });

                $(document).on('input', '[name="jenis_sumber[]"], [name="penjelasan_sumber[]"]', updatePreview);
            }

            // Button handlers
            $('#save-draft-btn').on('click', function () {
                $('#form-action').val('save_draft');
                $('#laporan-form').submit();
            });

            $('#submit-review-btn').on('click', function () {
                $('#confirmation-modal').removeClass('hidden');
            });

            $('#cancel-submit').on('click', function () {
                $('#confirmation-modal').addClass('hidden');
            });

            $('#confirm-submit').on('click', function () {
                $('#form-action').val('submit_review');
                $('#confirmation-modal').addClass('hidden');
                $('#laporan-form').submit();
            });

            // Initial metodologi selection
            $('input[name="metodologi_option"]:checked').closest('.metodologi-option').addClass('selected');

            // Initial preview
            setTimeout(updatePreview, 300);

            // Form submit handler
            $('#laporan-form').on('submit', function (e) {
                $('#informasi_pemeriksaan').val($('#informasi_pemeriksaan').summernote('code'));
                $('#tujuan_pemeriksaan').val($('#tujuan_pemeriksaan').summernote('code'));
                $('#barang_bukti').val($('#barang_bukti').summernote('code'));
                $('#hasil_pemeriksaan').val($('#hasil_pemeriksaan').summernote('code'));
                $('#kesimpulan').val($('#kesimpulan').summernote('code'));
            });
        });
    </script>
</x-app-layout>