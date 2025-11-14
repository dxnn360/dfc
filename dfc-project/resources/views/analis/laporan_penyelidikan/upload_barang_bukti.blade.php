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

            <form id="laporan-form" action="{{ route('analis.laporan.upload-barang-bukti', $laporan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                    <!-- Form Section -->
                    <div class="space-y-6">
                        <!-- Status Barang Bukti Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <div class="w-2 h-6 bg-yellow-600 rounded-full"></div>
                                Status Barang Bukti
                            </h3>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status Barang
                                    Bukti</label>
                                <select name="status_barang_bukti" id="status_barang_bukti"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                                    <option value="">Pilih Status</option>
                                    <option value="Sudah Diterima" {{ $laporan->status_barang_bukti == 'Sudah Diterima' ? 'selected' : '' }}>Sudah Diterima</option>
                                    <option value="Belum Dikirimkan" {{ $laporan->status_barang_bukti == 'Belum Dikirimkan' ? 'selected' : '' }}>Belum Dikirimkan</option>
                                    <option value="Dikembalikan" {{ $laporan->status_barang_bukti == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                </select>
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

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold py-4 px-6 rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Barang Bukti
                            </div>
                        </button>
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

            function HideElementOnCondition() {
                const status = $('#status_barang_bukti').val();

                if (status === 'Belum Dikirimkan' || status === '') {
                    $('#evidence-card').addClass('hidden');
                    $('#sumber-section').addClass('hidden');
                } else {
                    $('#evidence-card').removeClass('hidden');
                    $('#sumber-section').removeClass('hidden');
                }
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

            // Call the hide/show behaviour on load
            HideElementOnCondition();

            // Trigger hide/show when dropdown changes
            $('#status_barang_bukti').on('change', function () {
                HideElementOnCondition();
                updatePreview();
            });


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