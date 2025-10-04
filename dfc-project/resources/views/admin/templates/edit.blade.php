<x-app-layout>
    <div class="px-4 py-6 md:mr-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between mb-6">
            <div class="mb-2 md:mb-0">
                <h1 class="text-sm text-gray-700">Hi, {{ auth()->user()->name }}👋</h1>
            </div>
            <div>
                <h1 class="text-sm text-gray-700" id="today"></h1>
            </div>
        </div>

        <!-- Title -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-semibold mb-2 text-gray-800">
                Edit Template {{ ucfirst(str_replace('_', ' ', $template->type)) }}
            </h1>
            <p class="text-sm text-gray-600">Silahkan atur template dokumen sesuai kebutuhan.</p>
        </div>

        <!-- Form + Preview -->
        <div class="flex flex-col xl:flex-row gap-6">
            <!-- Form -->
            <div class="xl:w-1/2">
                <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 md:p-8 h-full">
                    <form method="POST" action="{{ route('templates.update', $template->type) }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Header -->
                        <div class="mb-6">
                            <label class="block mb-2 font-medium text-gray-700">Header</label>
                            <textarea id="header" name="header" class="summernote">{{ old('header', $template->header) }}</textarea>
                        </div>

                        <!-- Footer -->
                        <div class="mb-6">
                            <label class="block mb-2 font-medium text-gray-700">Footer</label>
                            <textarea id="footer" name="footer" class="summernote">{{ old('footer', $template->footer) }}</textarea>
                        </div>

                        <!-- Logo -->
                        <div class="mb-6">
                            <label class="block mb-2 font-medium text-gray-700">Logo</label>
                            <input type="file" name="logo" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @if($template->logo)
                                <div class="mt-3">
                                    <p class="text-sm text-gray-500 mb-1">Current logo:</p>
                                    <img src="{{ asset('storage/' . $template->logo) }}" alt="Logo" class="h-12 border border-gray-200 rounded">
                                </div>
                            @endif
                        </div>

                        <!-- Format Tanggal -->
                        <div class="mb-6">
                            <label class="block mb-2 font-medium text-gray-700">Format Tanggal</label>
                            <select name="format_tanggal" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="d/m/Y" {{ $template->format_tanggal == 'd/m/Y' ? 'selected' : '' }}>04/09/2025</option>
                                <option value="d-m-Y" {{ $template->format_tanggal == 'd-m-Y' ? 'selected' : '' }}>04-09-2025</option>
                                <option value="d F Y" {{ $template->format_tanggal == 'd F Y' ? 'selected' : '' }}>04 September 2025</option>
                                <option value="F d, Y" {{ $template->format_tanggal == 'F d, Y' ? 'selected' : '' }}>September 04, 2025</option>
                            </select>
                        </div>

                        <!-- Placeholder -->
                        <div class="mb-6">
                            <label class="block mb-2 font-medium text-gray-700">Placeholder</label>
                            <p class="text-xs text-gray-500 mb-3">
                                Klik placeholder untuk menyisipkan ke dalam editor aktif.
                            </p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($placeholders as $key => $desc)
                                    <span
                                        class="px-3 py-1.5 bg-gray-100 rounded-md text-xs font-mono cursor-pointer placeholder-item hover:bg-gray-200 transition-colors"
                                        title="{{ $desc }}">
                                        {{ $key }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Body -->
                        <div class="mb-6">
                            <label class="block mb-2 font-medium text-gray-700">Isi Template</label>
                            <textarea id="body" name="body" class="summernote">{{ old('body', $template->body) }}</textarea>
                        </div>

                        <!-- Tombol -->
                        <div class="flex flex-col sm:flex-row justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.dashboard') }}"
                                class="bg-gray-100 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-200 transition-colors text-center font-medium">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Preview -->
            <div class="xl:w-1/2 mt-6 xl:mt-0">
                <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 md:p-8 h-full flex flex-col">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Preview Dokumen</h2>
                        <div class="text-xs text-gray-500">A4 Ratio</div>
                    </div>
                    <div id="preview-wrapper" class="overflow-y-auto bg-gray-50 rounded-lg p-4 flex-1 flex items-center justify-center">
                        <!-- Halaman akan di-generate otomatis oleh JS -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahin library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <style>
        #preview-wrapper {
            background: #f9fafb;
            padding: 20px;
            min-height: 500px;
        }

        .page-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .page {
            /* A4 ratio: 1:1.414 (210mm:297mm) */
            width: 100%;
            max-width: 400px;
            height: calc(400px * 1.414);
            padding: 25px;
            background: white;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        .page-header {
            margin-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 10px;
        }

        .page-content {
            flex: 1;
            word-wrap: break-word;
            line-height: 1.6;
            /* Remove semua properti scroll */
            overflow: visible;
            max-height: none;
            height: auto;
        }

        .page-footer {
            margin-top: 15px;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
            text-align: center;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .page-indicator {
            font-size: 0.75rem;
            color: #6b7280;
            text-align: center;
            margin-top: 5px;
        }

        /* Adjust Summernote height to fit better in 50/50 layout */
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
            padding: 10px !important;
            min-height: 150px !important;
            max-height: 200px !important;
        }
        
        .note-editor.note-frame .note-editing-area {
            min-height: 150px !important;
        }

        /* Responsive adjustments */
        @media (max-width: 1280px) {
            .page {
                max-width: 350px;
                height: calc(350px * 1.414);
            }
        }

        @media (max-width: 1024px) {
            .page {
                max-width: 100%;
                height: auto;
                min-height: 400px;
                aspect-ratio: 1/1.414;
            }
            
            .note-editor.note-frame .note-editing-area .note-editable {
                max-height: 250px !important;
            }
        }

        @media (max-width: 768px) {
            .page {
                max-width: 100%;
                height: auto;
                min-height: 300px;
            }
        }

        @media print {
            .page {
                margin: 0;
                border: none;
                box-shadow: none;
                width: auto;
                height: auto;
                min-height: auto;
                padding: 0;
            }
        }
    </style>

    <script>
        let activeEditor = '#body'; // default target body

        function updatePreview() {
            const header = $('#header').summernote('code');
            const body = $('#body').summernote('code');
            const footer = $('#footer').summernote('code');

            // gabung konten jadi satu halaman
            const fullContent = `
                <div class="page-container">
                    <div class="page">
                        <div class="page-header">${header}</div>
                        <div class="page-content">${body}</div>
                        <div class="page-footer">${footer}</div>
                    </div>
                    <div class="page-indicator">Halaman 1</div>
                </div>
            `;

            // inject ke wrapper
            $('#preview-wrapper').html(fullContent);
        }

        $(document).ready(function () {
            // Set today's date
            const today = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('today').textContent = today.toLocaleDateString('id-ID', options);
            
            $('.summernote').summernote({
                placeholder: 'Tulis di sini...',
                tabsize: 2,
                height: 180,
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

            // Insert placeholder ke editor aktif
            $(document).on('click', '.placeholder-item', function () {
                let placeholder = $(this).text();
                let editor = $(activeEditor);

                editor.summernote('editor.restoreRange');
                editor.summernote('editor.focus');
                editor.summernote('editor.insertText', placeholder);

                updatePreview();
            });

            updatePreview(); // init preview pertama kali
        });
    </script>
</x-app-layout>