<x-app-layout>
    <div class="min-h-screen bg-white py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                            {{ isset($surat_tugas) ? 'Edit Surat Tugas' : 'Buat Surat Tugas' }}
                        </h1>
                        <p class="mt-2 text-gray-600">
                            Isi data di bawah untuk {{ isset($surat_tugas) ? 'memperbarui' : 'membuat' }} surat tugas.
                        </p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border">
                            Hi, {{ auth()->user()->name }}👋
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                <!-- Form Section -->
                <div class="space-y-6">
                    <form method="POST" 
                          action="{{ isset($surat_tugas) ? route('analis.surat_tugas.update', $surat_tugas) : route('analis.surat_tugas.store') }}"
                          id="form-surat">
                        @csrf
                        @if(isset($surat_tugas))
                            @method('PUT')
                        @endif

                        <!-- Pilih Ahli Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <div class="w-2 h-6 bg-blue-600 rounded-full"></div>
                                Pilih Ahli
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Ahli</label>
                                    <select id="ahli" name="user_ids[]"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors"
                                        multiple required>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}"
                                                @if(isset($selectedUsers) && in_array($user->id, $selectedUsers)) selected @endif
                                                data-nama="{{ $user->name }}"
                                                data-nik="{{ $user->nik ?? '-' }}"
                                                data-position="{{ $user->position ?? '-' }}"
                                                data-desc="{{ $user->desc ?? '-' }}">
                                                {{ $user->name }} ({{ $user->position ?? 'Tanpa Jabatan' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-xs text-gray-500 mt-1">Gunakan Ctrl/Cmd + klik untuk memilih multiple</p>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Surat Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <div class="w-2 h-6 bg-green-600 rounded-full"></div>
                                Informasi Surat
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Surat</label>
                                    <input type="text" id="nomor_surat" name="nomor_surat"
                                        value="{{ old('nomor_surat', $surat_tugas->nomor_surat ?? $nomorSurat ?? '') }}"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-50 text-gray-600 focus:outline-none" 
                                        readonly>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                                        <input type="date" id="tanggal" name="tanggal"
                                            value="{{ old('tanggal', $surat_tugas->tanggal ?? '') }}"
                                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors"
                                            required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Sumber Permintaan</label>
                                        <input type="text" id="sumber_permintaan" name="sumber_permintaan"
                                            value="{{ old('sumber_permintaan', $surat_tugas->sumber_permintaan ?? '') }}"
                                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Kasus Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <div class="w-2 h-6 bg-purple-600 rounded-full"></div>
                                Detail Kasus
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Ringkasan Kasus</label>
                                    <textarea id="ringkasan_kasus" name="ringkasan_kasus" rows="4"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors resize-none"
                                        required>{{ old('ringkasan_kasus', $surat_tugas->ringkasan_kasus ?? '') }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pemohon</label>
                                    <input type="text" id="nama_pemohon" name="nama_pemohon"
                                        value="{{ old('nama_pemohon', $surat_tugas->nama_pemohon ?? '') }}"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors"
                                        required>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <a href="{{ route('analis.document') }}" 
                               class="flex items-center justify-center gap-2 bg-white border border-gray-300 text-gray-700 font-medium py-3 px-6 rounded-lg hover:bg-gray-50 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Kembali
                            </a>
                            <button type="submit" 
                                    class="flex items-center justify-center gap-2 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold py-3 px-6 rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ isset($surat_tugas) ? 'Update Surat Tugas' : 'Simpan Surat Tugas' }}
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
                                Preview Surat Tugas
                            </h2>
                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>A4 Ratio (210mm × 297mm)</span>
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
            padding: 25mm;
            display: flex;
            flex-direction: column;
        }

        .a4-header {
            margin-bottom: 15mm;
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 5mm;
        }

        .a4-body {
            flex: 1;
            text-align: justify;
            margin: 20px 0;
        }

        .a4-footer {
            margin-top: 15mm;
            text-align: center;
            border-top: 1px solid #000;
            padding-top: 5mm;
            font-size: 10pt;
        }

        .preview-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            font-size: 10pt;
        }

        .preview-table th,
        .preview-table td {
            border: 1px solid #000;
            padding: 4px 6px;
            text-align: left;
        }

        .preview-table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .nomor-surat {
            font-weight: bold;
            font-size: 11pt;
            margin-bottom: 3mm;
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
            const TEMPLATE = @json([
                'header' => $template->header ?? '<div style="text-align:center;"><h3>INSTANSI</h3><p>SURAT TUGAS</p></div>',
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

            function buildAhliTable() {
                const ahliSelect = document.getElementById('ahli');
                const selectedOptions = Array.from(ahliSelect.selectedOptions);
                
                if (selectedOptions.length === 0) {
                    return '<p style="text-align: center; font-style: italic; color: #666;">Belum ada ahli dipilih</p>';
                }

                let table = `
                    <table class="preview-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jabatan</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                `;
                
                selectedOptions.forEach(option => {
                    table += `
                        <tr>
                            <td>${option.dataset.nama || ''}</td>
                            <td>${option.dataset.nik || ''}</td>
                            <td>${option.dataset.position || ''}</td>
                            <td>${option.dataset.desc || ''}</td>
                        </tr>
                    `;
                });
                
                table += `
                        </tbody>
                    </table>
                `;
                
                return table;
            }

            function updatePreview() {
                let header = TEMPLATE.header;
                let body = TEMPLATE.body;
                let footer = TEMPLATE.footer;

                const data = {
                    nomor_surat: document.getElementById('nomor_surat')?.value || 'NOMOR/BELUM/TERISI',
                    tanggal: formatDateToLong(document.getElementById('tanggal')?.value) || '',
                    sumber_permintaan: document.getElementById('sumber_permintaan')?.value || '',
                    ringkasan_kasus: document.getElementById('ringkasan_kasus')?.value || '',
                    nama_pemohon: document.getElementById('nama_pemohon')?.value || '',
                    daftar_ahli: buildAhliTable(),
                };

                // Replace semua placeholder
                Object.keys(data).forEach(key => {
                    header = replacePlaceholders(header, key, data[key]);
                    body = replacePlaceholders(body, key, data[key]);
                    footer = replacePlaceholders(footer, key, data[key]);
                });

                // Render preview dengan ukuran A4 penuh
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
            const formElements = ['nomor_surat', 'tanggal', 'sumber_permintaan', 'ringkasan_kasus', 'nama_pemohon'];
            formElements.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', updatePreview);
                    el.addEventListener('change', updatePreview);
                }
            });

            // Event listener untuk select ahli
            const ahliSelect = document.getElementById('ahli');
            if (ahliSelect) {
                ahliSelect.addEventListener('change', updatePreview);
            }

            // Set default tanggal ke hari ini jika create mode
            @if(!isset($surat_tugas))
                const today = new Date().toISOString().split('T')[0];
                document.getElementById('tanggal').value = today;
            @endif

            // Initial preview
            setTimeout(updatePreview, 100);
        });
    </script>
</x-app-layout>