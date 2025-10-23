<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Buat Laporan Penyelidikan</h1>
                        <p class="mt-2 text-gray-600">Isi form berikut untuk membuat laporan penyelidikan baru</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <div id="today" class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border"></div>
                    </div>
                </div>
            </div>

            <form action="{{ route('analis.laporan.store') }}" method="POST" id="laporan-form">
                @csrf
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
                                    <input type="text" value="{{ $nomorSurat }}" name="nomor_surat" id="nomor_surat"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-50 text-gray-600 focus:outline-none" readonly>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" 
                                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pemohon</label>
                                    <input type="text" name="nama_pemohon" id="nama_pemohon"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Unit Kerja Pemohon</label>
                                    <input type="text" name="jabatan_pemohon" id="jabatan_pemohon"
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
                                              placeholder="Jelaskan informasi lengkap mengenai pemeriksaan..."></textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tujuan Pemeriksaan</label>
                                    <textarea name="tujuan_pemeriksaan" id="tujuan_pemeriksaan" rows="3"
                                              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors resize-none"
                                              placeholder="Tujuan dari pemeriksaan ini..."></textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Metodologi</label>
                                    <div class="space-y-3">
                                        @php
                                            $metodologiData = ['option' => 'a', 'value' => ''];
                                            $selectedOption =  $metodologiData['option'] ?? 'a';
                                            $metodologiValue =  $metodologiData['value'] ?? '';
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
                                    <input type="text" name="barang_bukti[]" 
                                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors"
                                           placeholder="Masukkan barang bukti...">
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
                                    <div class="flex gap-3">
                                        <input type="text" name="jenis_sumber[]" placeholder="Jenis Sumber" 
                                               class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                                        <input type="text" name="penjelasan_sumber[]" placeholder="Penjelasan" 
                                               class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                                    </div>
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
                                              placeholder="Hasil yang diperoleh dari pemeriksaan..."></textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kesimpulan</label>
                                    <textarea name="kesimpulan" id="kesimpulan" rows="3"
                                              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors resize-none"
                                              placeholder="Kesimpulan dari penyelidikan..."></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold py-4 px-6 rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Laporan Penyelidikan
                            </div>
                        </button>
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
                            
                            <!-- Preview Container dengan scroll horizontal dan vertikal -->
                            <div id="preview-container" class="border-2 border-gray-200 rounded-lg bg-gray-50 overflow-auto">
                                <div id="preview-area" class="p-4">
                                    <!-- Preview akan di-render di sini -->
                                    <div class="text-center text-gray-500 py-20" style="width: 210mm;">
                                        <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p>Preview akan muncul di sini</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Scroll Indicator -->
                            <div class="flex justify-between items-center mt-2 text-xs text-gray-500">
                                <span>← Scroll untuk melihat seluruh dokumen →</span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
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

    <style>
        /* Preview Container Styling */
        #preview-container {
            height: 800px;
            overflow: auto;
            background: #f8f9fa;
            position: relative;
        }

        /* Preview Content Styling - FULL A4 SIZE */
        .preview-content {
            width: 210mm;
            min-height: 297mm;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            margin: 0 auto;
            font-family: 'Calibri', serif;
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

        /* Styling untuk scrollbar */
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

        #preview-container::-webkit-scrollbar-corner {
            background: #f1f1f1;
        }

        /* Print styles */
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Set today's date
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal').value = today;
            
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const todayDisplay = new Date().toLocaleDateString('id-ID', options);
            document.getElementById('today').textContent = todayDisplay;

            const TEMPLATE = @json([
                'header' => $template->header ?? '<div style="text-align:center;"><h3>INSTANSI</h3><p>LAPORAN PENYELIDIKAN</p></div>',
                'body' => $template->body ?? '<div class="section-title">I. INFORMASI UMUM</div><p>Template body belum diatur</p>',
                'footer' => $template->footer ?? '<p style="text-align:center;">Footer template</p>'
            ]);

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
                        rows += `<tr><td class="number-col">${counter}</td><td>${v.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</td></tr>`;
                        counter++;
                        hasItems = true;
                    }
                });
                
                if (!hasItems) return '<p class="content-paragraph">Tidak ada barang bukti</p>';
                
                return `<table class="preview-table">
                    <thead>
                        <tr>
                            <th class="number-col">No</th>
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
                            <td class="number-col">${counter}</td>
                            <td class="jenis-col">${jenis[i].value.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</td>
                            <td class="penjelasan-col">${penjelasan[i].value.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</td>
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
                const selectedOption = document.querySelector('input[name="metodologi_option"]:checked');
                if (!selectedOption) return 'Belum dipilih';
                
                const option = selectedOption.value;
                const valueInput = document.querySelector(`[name="metodologi_${option}_value"]`);
                
                if (valueInput) {
                    const value = valueInput.value.trim();
                    if (value) return value;
                    
                    // Return default descriptions if no custom value
                    switch(option) {
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
                    nomor_surat: document.getElementById('nomor_surat')?.value || 'NOMOR/BELUM/TERISI',
                    tanggal: formatDateToLong(document.getElementById('tanggal')?.value) || '',
                    nama_pemohon: document.getElementById('nama_pemohon')?.value || '-',
                    jabatan_pemohon: document.getElementById('jabatan_pemohon')?.value || '-',
                    info: document.getElementById('informasi_pemeriksaan')?.value || 'Belum diisi',
                    barang_bukti: buildBarangBuktiTable(),
                    tujuan: document.getElementById('tujuan_pemeriksaan')?.value || 'Belum diisi',
                    metodologi: getSelectedMetodologi(),
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
                    <div class="preview-content">
                        <div class="a4-page">
                            <div class="a4-header">${header}</div>
                            <div class="a4-body">${body}</div>
                            <div class="a4-footer">${footer}</div>
                        </div>
                    </div>
                `;

                // Auto-scroll ke kiri atas setelah update
                const previewContainer = document.getElementById('preview-container');
                previewContainer.scrollLeft = 0;
                previewContainer.scrollTop = 0;
            }

            // Event listeners untuk semua input
            const formElements = [
                'nomor_surat', 'tanggal', 'nama_pemohon', 'jabatan_pemohon',
                'informasi_pemeriksaan', 'tujuan_pemeriksaan',
                'hasil_pemeriksaan', 'kesimpulan'
            ];

            formElements.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', updatePreview);
                    el.addEventListener('change', updatePreview);
                }
            });

            // Event listeners untuk metodologi
            document.querySelectorAll('input[name="metodologi_option"]').forEach(radio => {
                radio.addEventListener('change', updatePreview);
            });

            document.querySelectorAll('.metodologi-input').forEach(input => {
                input.addEventListener('input', updatePreview);
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

            // Initial preview
            setTimeout(updatePreview, 100);
        });
    </script>
</x-app-layout>