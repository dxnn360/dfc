<x-app-layout>
<div class="flex gap-6">
    <!-- Left: Detail -->
    <div class="w-1/2 p-4 border rounded">
        <h2 class="font-bold text-lg mb-4">Detail Surat Tugas</h2>
        <p><strong>Nomor:</strong> {{ $surat->nomor_surat }}</p>
        <p><strong>Tanggal:</strong> {{ $surat->tanggal }}</p>
        <p><strong>Sumber Permintaan:</strong> {{ $surat->sumber_permintaan }}</p>
        <p><strong>Ringkasan Kasus:</strong> {{ $surat->ringkasan_kasus }}</p>
        <p><strong>Status:</strong> {{ ucfirst($surat->status) }}</p>
        <p><strong>Catatan Supervisor:</strong> {{ $surat->catatan_supervisor ?? '-' }}</p>

        <!-- Approve / Reject Form -->
        <form action="{{ route('supervisor.surat-tugas.approve', $surat->id) }}" method="POST" class="inline">
            @csrf
            <button class="bg-green-500 text-white px-4 py-2 rounded">Approve</button>
        </form>

        <form action="{{ route('supervisor.surat-tugas.reject', $surat->id) }}" method="POST" class="inline ml-2">
            @csrf
            <input type="text" name="catatan_supervisor" placeholder="Catatan" class="border px-2 py-1">
            <button class="bg-red-500 text-white px-4 py-2 rounded">Reject</button>
        </form>
    </div>

    <!-- Right: PDF Preview -->
    <div class="w-1/2 border rounded overflow-hidden">
        <iframe src="{{ route('supervisor.surat-tugas.pdf', $surat->id) }}" class="w-full h-[800px]"></iframe>
    </div>
</div>
</x-app-layout>
