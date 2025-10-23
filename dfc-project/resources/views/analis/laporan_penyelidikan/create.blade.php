<x-app-layout>
    <!-- Summernote CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">

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
                        <div id="today" class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border">
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('analis.laporan.store') }}" method="POST" id="laporan-form"
                enctype="multipart/form-data">
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
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-50 text-gray-600 focus:outline-none"
                                        readonly>
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
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Unit Kerja
                                        Pemohon</label>
                                    <input type="text" name="jabatan_pemohon" id="jabatan_pemohon"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" id="pekerjaan"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Instansi Pemohon</label>
                                    <input type="text" name="organisasi" id="organisasi"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Sumber
                                        Permintaan</label>
                                    <input type="text" name="sumber_permintaan" id="sumber_permintaan"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                    <input type="text" name="no_telp" id="no_telp"
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
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Informasi
                                        Pemeriksaan</label>
                                    <textarea name="informasi_pemeriksaan" id="informasi_pemeriksaan"></textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tujuan
                                        Pemeriksaan</label>
                                    <textarea name="tujuan_pemeriksaan" id="tujuan_pemeriksaan"></textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Metodologi</label>
                                    <input type="text" name="metodologi" id="metodologi"
                                        placeholder="Isi metodologi di sini..."
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-200 transition-colors">
                                    <p class="text-xs text-gray-500">
                                        Contoh: "Analisis Digital Forensik Standar menggunakan tools forensik digital
                                        seperti FTK Imager, Autopsy, dan Wireshark"
                                    </p>
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
                                <textarea name="barang_bukti" id="barang_bukti"></textarea>
                                <p class="mt-2 text-xs text-gray-500">
                                    💡 Tips: Gunakan numbering/bullet untuk membuat daftar barang bukti. Anda juga bisa
                                    menambahkan foto barang bukti.
                                </p>
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
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
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Hasil
                                        Pemeriksaan</label>
                                    <textarea name="hasil_pemeriksaan" id="hasil_pemeriksaan"></textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kesimpulan</label>
                                    <textarea name="kesimpulan" id="kesimpulan"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold py-4 px-6 rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
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

        /* Summernote customization */
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

    <!-- jQuery (required for Summernote) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function () {
            // Set today's date
            const today = new Date().toISOString().split('T')[0];
            $('#tanggal').val(today);

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
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function (contents) {
                        updatePreview();
                    },
                    onImageUpload: function (files) {
                        for (let i = 0; i < files.length; i++) {
                            uploadImage(files[i], $(this));
                        }
                    }
                }
            };

            $('#informasi_pemeriksaan').summernote(summernoteConfig);
            $('#tujuan_pemeriksaan').summernote(summernoteConfig);
            $('#barang_bukti').summernote(summernoteConfig);
            $('#hasil_pemeriksaan').summernote(summernoteConfig);
            $('#kesimpulan').summernote(summernoteConfig);

            // Image upload handler
            function uploadImage(file, editor) {
                const data = new FormData();
                data.append("file", file);

                $.ajax({
                    url: 'upload-image', // route Laravel upload
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

            function updatePreview() {
                let header = TEMPLATE.header;
                let body = TEMPLATE.body;
                let footer = TEMPLATE.footer;

                const data = {
                    nomor_surat: $('#nomor_surat').val() || 'NOMOR/BELUM/TERISI',
                    tanggal: formatDateToLong($('#tanggal').val()) || '',
                    nama_pemohon: $('#nama_pemohon').val() || '-',
                    sumber_permintaan: $('#sumber_permintaan').val() || '-',
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

                const previewContainer = document.getElementById('preview-container');
                previewContainer.scrollLeft = 0;
                previewContainer.scrollTop = 0;
            }

            // Event listeners untuk basic inputs
            $('#nomor_surat, #tanggal, #nama_pemohon, #jabatan_pemohon').on('input change', updatePreview);

            // Event listeners untuk metodologi
            $('input[name="metodologi_option"]').on('change', function () {
                $('.metodologi-option').removeClass('selected');
                $(this).closest('.metodologi-option').addClass('selected');
                updatePreview();
            });

            $('.metodologi-input').on('input', updatePreview);

            // Dynamic sumber
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

            // Remove buttons with event delegation
            $(document).on('click', '.remove-sumber', function () {
                $(this).closest('.flex').remove();
                updatePreview();
            });

            // Event delegation for dynamic sumber inputs
            $(document).on('input', '[name="jenis_sumber[]"], [name="penjelasan_sumber[]"]', updatePreview);

            // Initial metodologi selection styling
            $('input[name="metodologi_option"]:checked').closest('.metodologi-option').addClass('selected');

            // Initial preview
            setTimeout(updatePreview, 300);

            // Form submit handler
            $('#laporan-form').on('submit', function (e) {
                // Ensure Summernote content is synced to textarea before submit
                $('#informasi_pemeriksaan').val($('#informasi_pemeriksaan').summernote('code'));
                $('#tujuan_pemeriksaan').val($('#tujuan_pemeriksaan').summernote('code'));
                $('#barang_bukti').val($('#barang_bukti').summernote('code'));
                $('#hasil_pemeriksaan').val($('#hasil_pemeriksaan').summernote('code'));
                $('#kesimpulan').val($('#kesimpulan').summernote('code'));
            });
        });
    </script>
</x-app-layout>