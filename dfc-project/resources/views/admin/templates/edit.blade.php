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
            <h1 class="text-3xl font-semibold mb-3">
                Edit Template {{ ucfirst(str_replace('_', ' ', $template->type)) }}
            </h1>
            <p class="text-sm">Silahkan atur template dokumen sesuai kebutuhan.</p>
        </div>

        <!-- Form + Preview -->
        <div class="flex gap-6">
            <!-- Form -->
            <div class="flex-1">
                <div class="bg-white rounded-xl shadow-lg border p-8 flex flex-col h-full">
                    <form method="POST" action="{{ route('templates.update', $template->type) }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Header -->
                        <div class="mb-4">
                            <label class="block mb-1 font-semibold">Header</label>
                            <textarea id="header" name="header" class="summernote">{{ old('header', $template->header) }}</textarea>
                        </div>

                        <!-- Footer -->
                        <div class="mb-4">
                            <label class="block mb-1 font-semibold">Footer</label>
                            <textarea id="footer" name="footer" class="summernote">{{ old('footer', $template->footer) }}</textarea>
                        </div>

                        <!-- Logo -->
                        <div class="mb-4">
                            <label class="block mb-1 font-semibold">Logo</label>
                            <input type="file" name="logo" class="w-full border rounded p-2">
                            @if($template->logo)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $template->logo) }}" alt="Logo" class="h-12">
                                </div>
                            @endif
                        </div>

                        <!-- Format Tanggal -->
                        <div class="mb-4">
                            <label class="block mb-1 font-semibold">Format Tanggal</label>
                            <select name="format_tanggal" class="w-full border rounded p-2">
                                <option value="d/m/Y" {{ $template->format_tanggal == 'd/m/Y' ? 'selected' : '' }}>04/09/2025</option>
                                <option value="d-m-Y" {{ $template->format_tanggal == 'd-m-Y' ? 'selected' : '' }}>04-09-2025</option>
                                <option value="d F Y" {{ $template->format_tanggal == 'd F Y' ? 'selected' : '' }}>04 September 2025</option>
                                <option value="F d, Y" {{ $template->format_tanggal == 'F d, Y' ? 'selected' : '' }}>September 04, 2025</option>
                            </select>
                        </div>

                        <!-- Body -->
                        <div class="mb-4">
                            <label class="block mb-1 font-semibold">Isi Template</label>
                            <textarea id="body" name="body" class="summernote">{{ old('body', $template->body) }}</textarea>
                        </div>

                        <!-- Tombol -->
                        <div class="flex justify-end gap-4 mt-6">
                            <a href="{{ route('admin.dashboard') }}"
                               class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300">
                                Batal
                            </a>
                            <button type="submit"
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Preview -->
            <div class="flex-1">
                <div class="bg-white rounded-xl shadow-lg border p-8 h-full flex flex-col">
                    <h2 class="text-lg font-semibold mb-4">Preview Dokumen</h2>
                    <div id="preview" class="border p-4 rounded h-full overflow-y-auto">
                        {!! $template->header !!}
                        <hr>
                        {!! $template->body !!}
                        <hr>
                        {!! $template->footer !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahin library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <script>
        function updatePreview() {
            $('#preview').html(
                $('#header').summernote('code') +
                '<hr>' +
                $('#body').summernote('code') +
                '<hr>' +
                $('#footer').summernote('code')
            );
        }

        $(document).ready(function () {
            $('.summernote').summernote({
                placeholder: 'Tulis di sini...',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['codeview']]
                ],
                callbacks: {
                    onChange: function () {
                        updatePreview();
                    }
                }
            });

            updatePreview(); // tampilkan preview awal
        });
    </script>
</x-app-layout>
