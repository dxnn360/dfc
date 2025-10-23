<x-app-layout>
    <div class="min-h-screen bg-white py-8">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                            Edit Template {{ ucfirst(str_replace('_', ' ', $template->type)) }}
                        </h1>
                        <p class="mt-2 text-gray-600">Atur dan sesuaikan template dokumen sesuai kebutuhan Anda</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <div id="today" class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border"></div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                <!-- Form Section -->
                <div class="space-y-6">
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                        <div class="flex items-center gap-2 mb-6">
                            <div class="w-2 h-6 bg-blue-600 rounded-full"></div>
                            <h2 class="text-xl font-semibold text-gray-900">Konfigurasi Template</h2>
                        </div>
                        
                        <form method="POST" action="{{ route('templates.update', $template->type) }}" enctype="multipart/form-data" class="space-y-6">
                            @csrf

                            <!-- Header Section -->
                            <div class="space-y-3">
                                <label class="block text-sm font-medium text-gray-700">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                        </svg>
                                        Header Template
                                    </span>
                                </label>
                                <textarea id="header" name="header" class="summernote">{{ old('header', $template->header) }}</textarea>
                            </div>

                                                        <!-- Placeholder Section -->
                            <div class="space-y-3">
                                <label class="block text-sm font-medium text-gray-700">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                        </svg>
                                        Placeholder Variabel
                                    </span>
                                </label>
                                <p class="text-xs text-gray-500">
                                    Klik placeholder untuk menyisipkan ke dalam editor aktif.
                                </p>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                                    @foreach($placeholders as $key => $desc)
                                        <button type="button" class="placeholder-item">
                                            <span class="font-mono text-xs">{{ $key }}</span>
                                            <span class="text-xs text-gray-500 truncate">{{ $desc }}</span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Body Section -->
                            <div class="space-y-3">
                                <label class="block text-sm font-medium text-gray-700">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                        </svg>
                                        Isi Template
                                    </span>
                                </label>
                                <textarea id="body" name="body" class="summernote">{{ old('body', $template->body) }}</textarea>
                            </div>

                            <!-- Footer Section -->
                            <div class="space-y-3">
                                <label class="block text-sm font-medium text-gray-700">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22 10v6M2 10v6M6 10v6M18 10v6M8 8h8M6 4h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                                        </svg>
                                        Footer Template
                                    </span>
                                </label>
                                <textarea id="footer" name="footer" class="summernote">{{ old('footer', $template->footer) }}</textarea>
                            </div>

                            <!-- Logo Upload -->
                            <div class="space-y-3">
                                <label class="block text-sm font-medium text-gray-700">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"/>
                                        </svg>
                                        Logo Perusahaan
                                    </span>
                                </label>
                                <div class="file-upload-container">
                                    <input type="file" name="logo" id="logo" class="hidden" accept=".jpg,.jpeg,.png,.svg">
                                    <label for="logo" class="file-upload-label">
                                        <div class="file-upload-content">
                                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                            <span id="logo_name" class="text-gray-500">Upload file logo</span>
                                            <span class="text-xs text-gray-400 mt-1">JPG, PNG, atau SVG (max. 2MB)</span>
                                        </div>
                                    </label>
                                </div>
                                @if($template->logo)
                                    <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                                        <p class="text-sm text-gray-600 mb-2">Logo saat ini:</p>
                                        <img src="{{ asset('storage/' . $template->logo) }}" alt="Logo" class="h-12 border border-gray-200 rounded">
                                    </div>
                                @endif
                            </div>

                            <!-- Format Tanggal -->
                            <div class="space-y-3">
                                <label class="block text-sm font-medium text-gray-700">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Format Tanggal
                                    </span>
                                </label>
                                <select name="format_tanggal" class="custom-select">
                                    <option value="d/m/Y" {{ $template->format_tanggal == 'd/m/Y' ? 'selected' : '' }}>04/09/2025</option>
                                    <option value="d-m-Y" {{ $template->format_tanggal == 'd-m-Y' ? 'selected' : '' }}>04-09-2025</option>
                                    <option value="d F Y" {{ $template->format_tanggal == 'd F Y' ? 'selected' : '' }}>04 September 2025</option>
                                    <option value="F d, Y" {{ $template->format_tanggal == 'F d, Y' ? 'selected' : '' }}>September 04, 2025</option>
                                    <option value="l, d F Y" {{ $template->format_tanggal == 'l, d F Y' ? 'selected' : '' }}>Kamis, 04 September 2025</option>
                                </select>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-4 pt-6 border-t border-gray-200">
                                <a href="{{ route('admin.dashboard') }}" class="flex-1 cancel-button">
                                    Batalkan
                                </a>
                                <button type="submit" class="flex-1 submit-button">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Simpan Template
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Preview Section -->
                <div class="space-y-6">
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-2">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <h2 class="text-xl font-semibold text-gray-900">Preview Template</h2>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>A4 Ratio</span>
                            </div>
                        </div>

                        <!-- Preview Container dengan Scroll -->
                        <div id="preview-container" class="border-2 border-gray-200 rounded-lg bg-gray-50 overflow-auto">
                            <div id="preview-area" class="p-4">
                                <!-- Preview akan di-render di sini -->
                                <div class="text-center text-gray-500 py-20">
                                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-600 mb-2">Preview Template</h3>
                                    <p class="text-sm text-gray-400">Edit template untuk melihat preview di sini</p>
                                </div>
                            </div>
                        </div>

                        <!-- Preview Info -->
                        <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <h4 class="text-sm font-medium text-blue-900">Tips Template yang Baik</h4>
                                    <ul class="mt-2 text-xs text-blue-700 space-y-1">
                                        <li>• Gunakan placeholder variabel untuk data dinamis</li>
                                        <li>• Format tanggal akan otomatis menyesuaikan pilihan</li>
                                        <li>• Preview akan update secara real-time saat editing</li>
                                        <li>• Logo dalam format vector (SVG) untuk kualitas terbaik</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <style>
        /* File Upload Styling */
        .file-upload-container {
            position: relative;
        }

        .file-upload-label {
            display: block;
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .file-upload-label:hover {
            border-color: #3b82f6;
            background: #f0f9ff;
        }

        .file-upload-label.dragover {
            border-color: #3b82f6;
            background: #dbeafe;
        }

        .file-upload-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Custom Select Styling */
        .custom-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            background: white;
            font-size: 0.875rem;
            color: #374151;
            transition: all 0.3s ease;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
        }

        .custom-select:focus {
            outline: none;
            border-color: #3b82f6;
            ring: 2px;
            ring-color: #3b82f6;
        }

        /* Placeholder Items */
        .placeholder-item {
            display: flex;
            flex-direction: column;
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: left;
            width: 100%;
        }

        .placeholder-item:hover {
            border-color: #3b82f6;
            background: #f0f9ff;
            transform: translateY(-1px);
        }

        /* Button Styling */
        .cancel-button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border: 2px solid #d1d5db;
            border-radius: 12px;
            background: white;
            color: #6b7280;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
        }

        .cancel-button:hover {
            background: #f3f4f6;
            color: #374151;
            border-color: #9ca3af;
        }

        .submit-button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .submit-button:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        /* Preview Container Styling */
        #preview-container {
            height: 600px;
            overflow: auto;
            background: #f8f9fa;
            position: relative;
        }

        /* Styling untuk scrollbar */
        #preview-container::-webkit-scrollbar {
            width: 8px;
            height: 8px;
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

        /* Preview Content Styling */
        .preview-content {
            width: 210mm;
            min-height: 297mm;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            font-family: 'Calibri', serif;
            font-size: 12pt;
            line-height: 1.6;
            padding: 25mm;
        }

        .preview-header {
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .preview-body {
            margin: 20px 0;
            text-align: justify;
        }

        .preview-footer {
            margin-top: 20px;
            padding-top: 10px;
            text-align: center;
            font-size: 10pt;
        }

        /* Summernote Customization */
        .note-editor.note-frame {
            border: 1px solid #d1d5db !important;
            border-radius: 0.5rem !important;
        }
        
        .note-editor.note-frame .note-toolbar {
            background-color: #f9fafb !important;
            border-bottom: 1px solid #e5e7eb !important;
            border-radius: 0.5rem 0.5rem 0 0 !important;
            padding: 8px !important;
        }
        
        .note-editor.note-frame .note-statusbar {
            background-color: #f9fafb !important;
            border-top: 1px solid #e5e7eb !important;
            border-radius: 0 0 0.5rem 0.5rem !important;
        }
        
        .note-editor.note-frame .note-editing-area .note-editable {
            padding: 12px !important;
            min-height: 120px !important;
            max-height: 200px !important;
            font-size: 14px !important;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .preview-content {
                width: 100%;
                min-height: auto;
                padding: 20px;
            }
            
            #preview-container {
                height: 400px;
            }
        }
    </style>

    <script>
        let activeEditor = '#body';

        function updatePreview() {
            const header = $('#header').summernote('code');
            const body = $('#body').summernote('code');
            const footer = $('#footer').summernote('code');

            const fullContent = `
                <div class="preview-content">
                    <div class="preview-header">${header}</div>
                    <div class="preview-body">${body}</div>
                    <div class="preview-footer">${footer}</div>
                </div>
            `;

            $('#preview-area').html(fullContent);
        }

        $(document).ready(function () {
            // Set today's date
            const today = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('today').textContent = today.toLocaleDateString('id-ID', options);

            // Initialize Summernote
            $('.summernote').summernote({
                placeholder: 'Tulis konten template di sini...',
                tabsize: 2,
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function () {
                        updatePreview();
                    },
                    onFocus: function () {
                        activeEditor = '#' + $(this).attr('id');
                    }
                }
            });

            // File upload handler
            $('#logo').on('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    $('#logo_name').text(file.name).addClass('text-gray-900 font-medium');
                    
                    // Preview logo in template
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        // You can add logo to preview here if needed
                        console.log('Logo uploaded:', file.name);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Drag and drop for file upload
            $('.file-upload-label').on('dragover', function (e) {
                e.preventDefault();
                $(this).addClass('dragover');
            }).on('dragleave', function (e) {
                e.preventDefault();
                $(this).removeClass('dragover');
            }).on('drop', function (e) {
                e.preventDefault();
                $(this).removeClass('dragover');
                const files = e.originalEvent.dataTransfer.files;
                if (files.length > 0) {
                    $('#logo')[0].files = files;
                    $('#logo').trigger('change');
                }
            });

            // Placeholder insertion
            $(document).on('click', '.placeholder-item', function () {
                const placeholder = $(this).find('.font-mono').text();
                const editor = $(activeEditor);

                editor.summernote('editor.restoreRange');
                editor.summernote('editor.focus');
                editor.summernote('editor.insertText', placeholder);

                updatePreview();
            });

            // Form submission handling
            $('form').on('submit', function (e) {
                const submitButton = $(this).find('button[type="submit"]');
                const originalText = submitButton.html();
                
                submitButton.html(`
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Menyimpan...
                `);
                submitButton.prop('disabled', true);
            });

            // Initial preview
            updatePreview();
        });
    </script>
</x-app-layout>