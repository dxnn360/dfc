<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Kelola Template Dokumen</h1>
        <p class="text-sm text-gray-600">Pilih template yang ingin diedit.</p>
    </div>

    <div class="bg-white shadow rounded p-6">
        <ul class="space-y-3">
            <li>
                <a href="{{ route('templates.edit', 'surat_tugas') }}"
                   class="text-blue-600 hover:underline">✍️ Template Surat Tugas</a>
            </li>
            <li>
                <a href="{{ route('templates.edit', 'surat_pengantar') }}"
                   class="text-blue-600 hover:underline">✍️ Template Surat Pengantar</a>
            </li>
            <li>
                <a href="{{ route('templates.edit', 'laporan_penyelidikan') }}"
                   class="text-blue-600 hover:underline">✍️ Template Laporan Penyelidikan</a>
            </li>
        </ul>
    </div>
</x-app-layout>
