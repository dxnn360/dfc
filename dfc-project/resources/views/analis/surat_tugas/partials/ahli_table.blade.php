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
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->nik ?? '-' }}</td>
                <td>{{ $user->position ?? '-' }}</td>
                <td>{{ $user->desc ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
