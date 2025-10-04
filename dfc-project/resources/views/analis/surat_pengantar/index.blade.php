<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Daftar Surat Pengantar</h2>
    </x-slot>

    <a href="{{ route('analis.surat_pengantar.create') }}">+ Buat Baru</a>

    <table>
        <thead>
            <tr>
                <th>Nomor Surat</th>
                <th>Tanggal</th>
                <th>Pemohon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($documents as $doc)
            <tr>
                <td>{{ $doc->nomor_surat }}</td>
                <td>{{ $doc->tanggal }}</td>
                <td>{{ $doc->nama_pemohon }}</td>
                <td>
                    <a href="{{ route('analis.surat_pengantar.edit', $doc) }}">Edit</a>
                    <a href="{{ route('analis.surat_pengantar.download', $doc) }}">Download PDF</a>
                    <form action="{{ route('analis.surat_pengantar.destroy', $doc) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-app-layout>
