<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Review Dokumen</h1>

        <div class="border rounded p-6 bg-white mb-6">
            <h2 class="text-xl font-semibold mb-2">Isi Dokumen</h2>
            {!! $document->data['ringkasan'] ?? '' !!}
        </div>

        <form method="POST" action="{{ route('supervisor.documents.verify', $document) }}" class="space-y-4">
            @csrf

            <div>
                <label>Status</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="approved">Setujui</option>
                    <option value="rejected">Tolak</option>
                </select>
            </div>

            <div>
                <label>Catatan Supervisor</label>
                <textarea name="catatan" class="w-full border rounded p-2" rows="4"></textarea>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Simpan Verifikasi</button>
        </form>
    </div>
</x-app-layout>
