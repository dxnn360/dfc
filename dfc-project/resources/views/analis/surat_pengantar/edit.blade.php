<x-app-layout>
    <div class="min-h-screen bg-white py-8">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Edit Surat Pengantar</h1>
                        <p class="mt-2 text-gray-600">Perbarui informasi surat pengantar dengan data yang valid</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <div id="today" class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border"></div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                <!-- Form Section -->
                <div class="space-y-6">
                    <form method="POST" action="{{ route('analis.surat_pengantar.update', $surat_pengantar->id) }}" id="form-surat">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <div class="w-2 h-6 bg-blue-600 rounded-full"></div>
                                Informasi Surat
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Surat</label>
                                    <input type="text" name="nomor_surat" id="nomor_surat"
                                        value="{{ old('nomor_surat', $surat_pengantar->nomor_surat) }}" readonly
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-50 text-gray-600 focus:outline-none">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                                        <input type="date" name="tanggal" id="tanggal" 
                                            value="{{ old('tanggal', $surat_pengantar->tanggal) }}"
                                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" required>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Klasifikasi</label>
                                        <select name="klasifikasi" id="klasifikasi" 
                                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" required>
                                            <option value="">-- Pilih Klasifikasi --</option>
                                            @foreach($klasifikasiOptions as $opt)
                                                <option value="{{ $opt }}" @selected(old('klasifikasi', $surat_pengantar->klasifikasi) == $opt)>
                                                    {{ $opt }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pemohon Information Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <div class="w-2 h-6 bg-green-600 rounded-full"></div>
                                Informasi Pemohon
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pemohon</label>
                                    <input type="text" name="nama_pemohon" id="nama_pemohon" 
                                        value="{{ old('nama_pemohon', $surat_pengantar->nama_pemohon) }}"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan Pemohon</label>
                                    <input type="text" name="jabatan_pemohon" id="jabatan_pemohon"
                                        value="{{ old('jabatan_pemohon', $surat_pengantar->jabatan_pemohon) }}" 
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" required>
                                </div>
                            </div>
                        </div>

                        <!-- Barang Bukti Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <div class="w-2 h-6 bg-purple-600 rounded-full"></div>
                                Barang Bukti
                            </h3>
                            <div class="space-y-4">
                                <div id="barang-bukti-section" class="space-y-3">
                                    @php
                                        $barangBukti = old('barang_bukti', json_decode($surat_pengantar->barang_bukti, true) ?? []);
                                    @endphp

                                    @foreach($barangBukti as $i => $bb)
                                        @if($i === 0)
                                            <!-- First item: dropdown from laporanList -->
                                            <div class="flex gap-3 items-start">
                                                <select name="barang_bukti[]" id="barang_bukti_first"
                                                    class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" required>
                                                    <option value="">-- Pilih dari Surat Laporan --</option>
                                                    @foreach($laporanList as $laporan)
                                                        <option value="{{ $laporan->nomor_surat }}"
                                                            @selected($bb == $laporan->nomor_surat)>
                                                            {{ $laporan->nomor_surat }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="button"
                                                    class="px-4 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors remove-bukti {{ $bb ? '' : 'hidden' }}">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        @else
                                            <!-- Additional items: free input -->
                                            <div class="flex gap-3 items-start">
                                                <input type="text" name="barang_bukti[]" value="{{ $bb }}"
                                                    class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors"
                                                    placeholder="Barang bukti tambahan">
                                                <button type="button"
                                                    class="px-4 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors remove-bukti">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    @endforeach

                                    @if(empty($barangBukti))
                                        <!-- Default dropdown if empty -->
                                        <div class="flex gap-3 items-start">
                                            <select name="barang_bukti[]" id="barang_bukti_first"
                                                class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" required>
                                                <option value="">-- Pilih dari Surat Laporan --</option>
                                                @foreach($laporanList as $laporan)
                                                    <option value="{{ $laporan->nomor_surat }}">
                                                        {{ $laporan->nomor_surat }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="button"
                                                class="px-4 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors remove-bukti hidden">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>
                                    @endif
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Simpan Perubahan
                                </div>
                            </button>
                        </div>
                    </form>
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

        .barang-bukti-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 11pt;
            table-layout: fixed;
        }

        .barang-bukti-table th,
        .barang-bukti-table td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .barang-bukti-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .barang-bukti-table .number-col {
            width: 50px;
            text-align: center;
        }

        .barang-bukti-table .bukti-col {
            width: auto;
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
            // Set today's date in display
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const todayDisplay = new Date().toLocaleDateString('id-ID', options);
            document.getElementById('today').textContent = todayDisplay;

            const TEMPLATE = @json([
                'header' => $template->header ?? '<div style="text-align:center;"><h3>INSTANSI</h3><p>SURAT PENGANTAR</p></div>',
                'body' => $template->body ?? '<p>Template body belum diatur</p>',
                'footer' => $template->footer ?? '<p>Footer template</p>'
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
                let hasValidItems = false;
                
                let table = `
                    <table class="barang-bukti-table">
                        <thead>
                            <tr>
                                <th class="number-col">No</th>
                                <th class="bukti-col">Barang Bukti</th>
                            </tr>
                        </thead>
                        <tbody>
                `;
                
                let counter = 1;
                inputs.forEach(el => {
                    const v = el.value || '';
                    if (v.trim() !== '') {
                        table += `
                            <tr>
                                <td class="number-col">${counter}</td>
                                <td class="bukti-col">${v.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</td>
                            </tr>
                        `;
                        counter++;
                        hasValidItems = true;
                    }
                });
                
                table += `
                        </tbody>
                    </table>
                `;
                
                if (!hasValidItems) {
                    return '<p style="text-align: center;">Tidak ada barang bukti</p>';
                }
                
                return table;
            }

            function updatePreview() {
                let header = TEMPLATE.header;
                let body = TEMPLATE.body;
                let footer = TEMPLATE.footer;

                const data = {
                    nomor_surat: document.getElementById('nomor_surat')?.value || 'NOMOR/BELUM/TERISI',
                    tanggal: formatDateToLong(document.getElementById('tanggal')?.value) || '',
                    nama_pemohon: document.getElementById('nama_pemohon')?.value || '',
                    jabatan_pemohon: document.getElementById('jabatan_pemohon')?.value || '',
                    klasifikasi: document.getElementById('klasifikasi')?.value || '',
                    barang_bukti: buildBarangBuktiTable(),
                };

                // Replace semua placeholder
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
            const formElements = ['nomor_surat', 'tanggal', 'nama_pemohon', 'jabatan_pemohon', 'klasifikasi'];
            formElements.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', updatePreview);
                    el.addEventListener('change', updatePreview);
                }
            });

            const buktiSection = document.getElementById('barang-bukti-section');
            if (buktiSection) {
                buktiSection.addEventListener('input', function(e) {
                    if (e.target.matches('[name="barang_bukti[]"]')) {
                        updatePreview();
                    }
                });
                
                buktiSection.addEventListener('change', function(e) {
                    if (e.target.matches('[name="barang_bukti[]"]')) {
                        updatePreview();
                    }
                });
            }

            // tombol tambah bukti
            document.getElementById('add-bukti').addEventListener('click', function () {
                const div = document.createElement('div');
                div.className = 'flex gap-3 items-start';
                div.innerHTML = `
                    <input type="text" name="barang_bukti[]" 
                           class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors"
                           placeholder="Barang bukti tambahan">
                    <button type="button" class="px-4 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors remove-bukti">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                `;
                buktiSection.appendChild(div);
                updatePreview();
            });

            // Event delegation for remove buttons
            document.addEventListener('click', function (e) {
                if (e.target.closest('.remove-bukti')) {
                    const parent = e.target.closest('.flex');
                    if (parent && parent.parentElement === buktiSection) {
                        // Don't remove if it's the first field and has value
                        const isFirstField = parent === buktiSection.firstElementChild;
                        const hasValue = parent.querySelector('select')?.value || parent.querySelector('input')?.value;
                        
                        if (isFirstField && hasValue) {
                            // Clear value but keep the field
                            const select = parent.querySelector('select');
                            const input = parent.querySelector('input');
                            if (select) select.value = '';
                            if (input) input.value = '';
                            parent.querySelector('.remove-bukti').classList.add('hidden');
                        } else if (!isFirstField) {
                            // Remove additional fields
                            parent.remove();
                        }
                        updatePreview();
                    }
                }
            });

            // Show remove button for the first item if it has a value
            const firstBuktiInput = document.getElementById('barang_bukti_first');
            if (firstBuktiInput) {
                firstBuktiInput.addEventListener('change', function() {
                    const firstRemoveBtn = this.nextElementSibling;
                    if (firstRemoveBtn && this.value) {
                        firstRemoveBtn.classList.remove('hidden');
                    } else if (firstRemoveBtn) {
                        firstRemoveBtn.classList.add('hidden');
                    }
                    updatePreview();
                });
                
                // Trigger initial state
                if (firstBuktiInput.value) {
                    const firstRemoveBtn = firstBuktiInput.nextElementSibling;
                    if (firstRemoveBtn) firstRemoveBtn.classList.remove('hidden');
                }
            }

            // Initial preview
            setTimeout(updatePreview, 100);
        });
    </script>
</x-app-layout>