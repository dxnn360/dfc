<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Edit Laporan Penyelidikan</h1>
                        <p class="mt-2 text-gray-600">Edit data laporan penyelidikan yang sudah ada</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <div id="today" class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border"></div>
                    </div>
                </div>
            </div>

            <form action="{{ route('analis.laporan.update', $laporan->id) }}" method="POST" id="laporan-form">
                @csrf
                @method('PUT')
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
                                    <input type="text" value="{{ old('nomor_surat', $laporan->nomor_surat) }}" name="nomor_surat" id="nomor_surat"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-50 text-gray-600 focus:outline-none" readonly>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" 
                                           value="{{ old('tanggal', (is_object($laporan->tanggal) && method_exists($laporan->tanggal, 'format')) ? $laporan->tanggal->format('Y-m-d') : ($laporan->tanggal ?? '')) }}"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pemohon</label>
                                    <input type="text" name="nama_pemohon" id="nama_pemohon"
                                           value="{{ old('nama_pemohon', $laporan->nama_pemohon) }}"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Unit Kerja Pemohon</label>
                                    <input type="text" name="jabatan_pemohon" id="jabatan_pemohon"
                                           value="{{ old('jabatan_pemohon', $laporan->jabatan_pemohon) }}"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
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
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Informasi Pemeriksaan</label>
                                    <textarea name="informasi_pemeriksaan" id="informasi_pemeriksaan" rows="4"
                                              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors resize-none"
                                              placeholder="Jelaskan informasi lengkap mengenai pemeriksaan...">{{ old('informasi_pemeriksaan', $laporan->informasi_pemeriksaan) }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tujuan Pemeriksaan</label>
                                    <textarea name="tujuan_pemeriksaan" id="tujuan_pemeriksaan" rows="3"
                                              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors resize-none"
                                              placeholder="Tujuan dari pemeriksaan ini...">{{ old('tujuan_pemeriksaan', $laporan->tujuan_pemeriksaan) }}</textarea>
                                </div>

                                <!-- Metodologi Options -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Metodologi</label>
                                    <div class="space-y-3">
                                        @php
                                            // Handle metodologi data berdasarkan struktur database
                                            $metodologiValue = old('metodologi', $laporan->metodologi ?? '');
                                            $selectedOption = 'a'; // Default to option A
                                            
                                            // Cek jika metodologi mengandung kata kunci untuk menentukan option
                                            if (str_contains(strtolower($metodologiValue), 'lanjutan') || str_contains(strtolower($metodologiValue), 'advanced')) {
                                                $selectedOption = 'b';
                                            } elseif (!empty($metodologiValue) && !str_contains(strtolower($metodologiValue), 'standar')) {
                                                $selectedOption = 'custom';
                                            }
                                        @endphp

                                        <!-- Option A -->
                                        <div class="flex items-start gap-3 p-4 border border-gray-200 rounded-lg hover:border-blue-300 transition-colors {{ $selectedOption == 'a' ? 'selected border-blue-300 bg-blue-50' : '' }}">
                                            <div class="flex items-center h-5 mt-1">
                                                <input type="radio" name="metodologi_option" value="a" id="metodologi_a" 
                                                       class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                                       {{ $selectedOption == 'a' ? 'checked' : '' }}>
                                            </div>
                                            <div class="flex-1">
                                                <label for="metodologi_a" class="block text-sm font-medium text-gray-700 mb-1">
                                                    Metodologi A - Analisis Digital Forensik Standar
                                                </label>
                                                <div class="space-y-2">
                                                    <input type="text" name="metodologi_a_value" 
                                                           value="{{ $selectedOption == 'a' ? $metodologiValue : '' }}"
                                                           placeholder="Kustomisasi nilai Metodologi A"
                                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-200 transition-colors metodologi-input"
                                                           data-option="a">
                                                    <p class="text-xs text-gray-500">
                                                        Contoh: "Pemeriksaan menggunakan tools forensik digital seperti FTK Imager, Autopsy, dan Wireshark"
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Option B -->
                                        <div class="flex items-start gap-3 p-4 border border-gray-200 rounded-lg hover:border-blue-300 transition-colors {{ $selectedOption == 'b' ? 'selected border-blue-300 bg-blue-50' : '' }}">
                                            <div class="flex items-center h-5 mt-1">
                                                <input type="radio" name="metodologi_option" value="b" id="metodologi_b" 
                                                       class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                                       {{ $selectedOption == 'b' ? 'checked' : '' }}>
                                            </div>
                                            <div class="flex-1">
                                                <label for="metodologi_b" class="block text-sm font-medium text-gray-700 mb-1">
                                                    Metodologi B - Investigasi Lanjutan
                                                </label>
                                                <div class="space-y-2">
                                                    <input type="text" name="metodologi_b_value" 
                                                           value="{{ $selectedOption == 'b' ? $metodologiValue : '' }}"
                                                           placeholder="Kustomisasi nilai Metodologi B"
                                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-200 transition-colors metodologi-input"
                                                           data-option="b">
                                                    <p class="text-xs text-gray-500">
                                                        Contoh: "Investigasi mendalam termasuk analisis memori, network traffic, dan timeline analysis"
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Custom Option -->
                                        <div class="flex items-start gap-3 p-4 border border-gray-200 rounded-lg hover:border-blue-300 transition-colors {{ $selectedOption == 'custom' ? 'selected border-blue-300 bg-blue-50' : '' }}">
                                            <div class="flex items-center h-5 mt-1">
                                                <input type="radio" name="metodologi_option" value="custom" id="metodologi_custom" 
                                                       class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                                       {{ $selectedOption == 'custom' ? 'checked' : '' }}>
                                            </div>
                                            <div class="flex-1">
                                                <label for="metodologi_custom" class="block text-sm font-medium text-gray-700 mb-1">
                                                    Metodologi Kustom
                                                </label>
                                                <textarea name="metodologi_custom_value" 
                                                          placeholder="Tulis metodologi kustom di sini..."
                                                          rows="3"
                                                          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-200 transition-colors resize-none metodologi-input"
                                                          data-option="custom">{{ $selectedOption == 'custom' ? $metodologiValue : '' }}</textarea>
                                            </div>
                                        </div>
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
                                <div id="bukti-wrapper" class="space-y-3 mb-4">
                                    @php
                                        $barangBukti = $laporan->barang_bukti ?? [];
                                    @endphp
                                    
                                    @foreach($barangBukti as $index => $bukti)
                                        <div class="flex gap-3 items-start">
                                            <input type="text" name="barang_bukti[]" 
                                                   value="{{ $oldBarangBukti[$index] ?? $bukti }}"
                                                   class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors"
                                                   placeholder="Masukkan barang bukti...">
                                            @if($index > 0 || !empty($oldBarangBukti) && count($oldBarangBukti) > 1)
                                                <button type="button" class="px-3 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors remove-bukti">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="add-bukti" 
                                        class="flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Tambah Barang Bukti
                                </button>
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
                                    @php
                                        $sumberData = $laporan->sumber ?? [];
                                    @endphp
                                    
                                    @foreach($sumberData as $index => $sumber)
                                        <div class="flex gap-3">
                                            <input type="text" name="jenis_sumber[]" placeholder="Jenis Sumber" 
                                                   value="{{ $sumber['jenis'] ?? '' }}"
                                                   class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                                            <input type="text" name="penjelasan_sumber[]" placeholder="Penjelasan" 
                                                   value="{{ $sumber['penjelasan'] ?? '' }}"
                                                   class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="add-sumber" 
                                        class="flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Tambah Sumber
                                </button>
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
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Hasil Pemeriksaan</label>
                                    <textarea name="hasil_pemeriksaan" id="hasil_pemeriksaan" rows="4"
                                              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors resize-none"
                                              placeholder="Hasil yang diperoleh dari pemeriksaan...">{{ old('hasil_pemeriksaan', $laporan->hasil_pemeriksaan) }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kesimpulan</label>
                                    <textarea name="kesimpulan" id="kesimpulan" rows="3"
                                              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors resize-none"
                                              placeholder="Kesimpulan dari penyelidikan...">{{ old('kesimpulan', $laporan->kesimpulan) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3 pt-6">
                            <a href="{{ route('analis.laporan.index') }}" 
                               class="flex-1 border-2 border-gray-500 text-gray-500 font-semibold py-3 px-6 rounded-xl hover:bg-gray-600 transition-all duration-200 shadow-lg hover:shadow-xl text-center">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="flex-1 bg-white border-2 border-blue-500 text-blue-500 font-semibold py-3 px-6 rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <div class="flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Ajukan untuk Review
                                </div>
                            </button>
                        </div>
                    </div>

                    <!-- Preview Section -->
                    <div class="space-y-6">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Preview Dokumen
                                </h2>
                                <div class="flex items-center gap-2 text-sm text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Update Real-time</span>
                                </div>
                            </div>
                            
                            <div id="preview-container" class="border-2 border-gray-200 rounded-lg bg-gray-50 overflow-hidden flex items-center justify-center" style="height: 800px;">
                                <div id="preview-area" class="preview-content">
                                    <!-- Preview akan di-render di sini -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .preview-content {
            transform: scale(0.68);
            transform-origin: center;
            width: 210mm;
            min-height: 297mm;
        }

        .a4-page {
            width: 210mm;
            min-height: 297mm;
            padding: 20mm;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            line-height: 1.6;
            overflow-wrap: break-word;
            word-wrap: break-word;
        }

        .a4-header,
        .a4-footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .a4-body {
            margin: 20px 0;
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

        /* Metodologi option styling */
        .selected {
            border-left-color: #3b82f6 !important;
            background-color: #f0f9ff !important;
            border-color: #3b82f6 !important;
        }

        /* Container styling */
        #preview-container {
            height: 800px;
            overflow-y: auto;
            overflow-x: hidden;
            background: #f8f9fa;
        }

        #preview-container::-webkit-scrollbar {
            width: 8px;
        }

        #preview-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        #preview-container::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        #preview-container::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Set today's date display
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const todayDisplay = new Date().toLocaleDateString('id-ID', options);
            document.getElementById('today').textContent = todayDisplay;

            const TEMPLATE = @json([
                'header' => $template->header ?? '<div style="text-align:center;"><h3>INSTANSI</h3><p>LAPORAN PENYELIDIKAN</p></div>',
                'body' => $template->body ?? '<div class="section-title">I. INFORMASI UMUM</div><p>Template body belum diatur</p>',
                'footer' => $template->footer ?? '<p style="text-align:center;">Footer template</p>'
            ]);

            // Default metodologi values
            const DEFAULT_METODOLOGI = {
                a: 'Pemeriksaan dilakukan menggunakan metodologi standar digital forensik yang meliputi acquisition, analysis, dan reporting dengan tools forensik yang terstandarisasi.',
                b: 'Pemeriksaan dilakukan menggunakan metodologi investigasi lanjutan yang mencakup analisis mendalam pada berbagai layer digital evidence termasuk memory analysis dan network forensics.',
                custom: ''
            };

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
                const inputs = document.querySelectorAll('[name="barang_bukti[]"]');
                let rows = '';
                let counter = 1;
                let hasItems = false;
                
                inputs.forEach(el => {
                    const v = el.value || '';
                    if (v.trim() !== '') {
                        rows += `<tr><td style="text-align: center; width: 50px;">${counter}</td><td>${v.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</td></tr>`;
                        counter++;
                        hasItems = true;
                    }
                });
                
                if (!hasItems) return '<p class="content-paragraph">Tidak ada barang bukti</p>';
                
                return `<table class="preview-table">
                    <thead>
                        <tr>
                            <th style="width: 50px; text-align: center;">No</th>
                            <th>Barang Bukti</th>
                        </tr>
                    </thead>
                    <tbody>${rows}</tbody>
                </table>`;
            }

            function buildSumberTable() {
                const jenis = document.querySelectorAll('[name="jenis_sumber[]"]');
                const penjelasan = document.querySelectorAll('[name="penjelasan_sumber[]"]');
                let rows = '';
                let counter = 1;
                let hasItems = false;
                
                for (let i = 0; i < jenis.length; i++) {
                    if (jenis[i].value.trim() || penjelasan[i].value.trim()) {
                        rows += `<tr>
                            <td style="text-align: center; width: 50px;">${counter}</td>
                            <td style="width: 30%;">${jenis[i].value.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</td>
                            <td>${penjelasan[i].value.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</td>
                        </tr>`;
                        counter++;
                        hasItems = true;
                    }
                }
                
                if (!hasItems) return '<p class="content-paragraph">Tidak ada sumber</p>';
                
                return `<table class="preview-table">
                    <thead>
                        <tr>
                            <th style="width: 50px; text-align: center;">No</th>
                            <th style="width: 30%;">Jenis Sumber</th>
                            <th>Penjelasan</th>
                        </tr>
                    </thead>
                    <tbody>${rows}</tbody>
                </table>`;
            }

            function getSelectedMetodologi() {
                const selectedOption = document.querySelector('input[name="metodologi_option"]:checked');
                if (!selectedOption) return '';
                
                const optionValue = selectedOption.value;
                
                if (optionValue === 'a') {
                    const customValue = document.querySelector('input[name="metodologi_a_value"]').value;
                    return customValue || DEFAULT_METODOLOGI.a;
                } else if (optionValue === 'b') {
                    const customValue = document.querySelector('input[name="metodologi_b_value"]').value;
                    return customValue || DEFAULT_METODOLOGI.b;
                } else if (optionValue === 'custom') {
                    return document.querySelector('textarea[name="metodologi_custom_value"]').value;
                }
                
                return '';
            }

            function updatePreview() {
                let header = TEMPLATE.header;
                let body = TEMPLATE.body;
                let footer = TEMPLATE.footer;

                const data = {
                    nomor_surat: document.getElementById('nomor_surat')?.value || 'NOMOR/BELUM/TERISI',
                    tanggal: formatDateToLong(document.getElementById('tanggal')?.value) || '',
                    nama_pemohon: document.getElementById('nama_pemohon')?.value || '-',
                    jabatan_pemohon: document.getElementById('jabatan_pemohon')?.value || '-',
                    info: document.getElementById('informasi_pemeriksaan')?.value || 'Belum diisi',
                    barang_bukti: buildBarangBuktiTable(),
                    tujuan: document.getElementById('tujuan_pemeriksaan')?.value || 'Belum diisi',
                    metodologi: getSelectedMetodologi() || 'Belum dipilih',
                    sumber: buildSumberTable(),
                    hasil: document.getElementById('hasil_pemeriksaan')?.value || 'Belum diisi',
                    kesimpulan: document.getElementById('kesimpulan')?.value || 'Belum diisi'
                };

                Object.keys(data).forEach(key => {
                    header = replacePlaceholders(header, key, data[key]);
                    body = replacePlaceholders(body, key, data[key]);
                    footer = replacePlaceholders(footer, key, data[key]);
                });

                document.getElementById('preview-area').innerHTML = `
                    <div class="a4-page">
                        <div class="a4-header">${header}</div>
                        <div class="a4-body">${body}</div>
                        <div class="a4-footer">${footer}</div>
                    </div>
                `;
            }

            // Metodologi option selection handler
            function handleMetodologiSelection() {
                const selectedOption = document.querySelector('input[name="metodologi_option"]:checked');
                if (selectedOption) {
                    // Remove selected class from all options
                    document.querySelectorAll('[name="metodologi_option"]').forEach(radio => {
                        radio.closest('.flex').classList.remove('selected');
                    });
                    
                    // Add selected class to current option
                    selectedOption.closest('.flex').classList.add('selected');
                }
                updatePreview();
            }

            // Event listeners for metodologi options
            document.querySelectorAll('input[name="metodologi_option"]').forEach(radio => {
                radio.addEventListener('change', handleMetodologiSelection);
            });

            // Event listeners for metodologi input fields
            document.querySelectorAll('.metodologi-input').forEach(input => {
                input.addEventListener('input', updatePreview);
            });

            // Other event listeners
            const formElements = [
                'nomor_surat', 'tanggal', 'nama_pemohon', 'jabatan_pemohon',
                'informasi_pemeriksaan', 'tujuan_pemeriksaan', 'hasil_pemeriksaan', 'kesimpulan'
            ];

            formElements.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', updatePreview);
                    el.addEventListener('change', updatePreview);
                }
            });

            // Dynamic barang bukti
            document.getElementById('add-bukti').addEventListener('click', function () {
                const wrapper = document.getElementById('bukti-wrapper');
                const div = document.createElement('div');
                div.className = 'flex gap-3 items-start';
                div.innerHTML = `
                    <input type="text" name="barang_bukti[]" 
                           class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors"
                           placeholder="Barang bukti tambahan">
                    <button type="button" class="px-3 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors remove-bukti">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                `;
                wrapper.appendChild(div);
                updatePreview();
            });

            // Dynamic sumber
            document.getElementById('add-sumber').addEventListener('click', function () {
                const wrapper = document.getElementById('sumber-wrapper');
                const div = document.createElement('div');
                div.className = 'flex gap-3';
                div.innerHTML = `
                    <input type="text" name="jenis_sumber[]" placeholder="Jenis Sumber" 
                           class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                    <input type="text" name="penjelasan_sumber[]" placeholder="Penjelasan" 
                           class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                `;
                wrapper.appendChild(div);
                updatePreview();
            });

            // Remove buttons
            document.addEventListener('click', function (e) {
                if (e.target.closest('.remove-bukti')) {
                    e.target.closest('.flex').remove();
                    updatePreview();
                }
            });

            // Initialize metodologi selection
            handleMetodologiSelection();

            // Initial preview
            setTimeout(updatePreview, 100);
        });
    </script>
</x-app-layout>