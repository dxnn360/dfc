<x-app-layout>
    <h1 class="text-xl font-bold mb-3">Tambah User</h1>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div>Nama: <input type="text" name="name" required></div>
        <div>Email: <input type="email" name="email" required></div>
        <div>Password: <input type="password" name="password" required></div>
        <div>
            Role:
            <select name="role" required>
                @foreach($roles as $r)
                    <option value="{{ $r->name }}">{{ ucfirst($r->name) }}</option>
                @endforeach
            </select>
        </div>
        <button class="bg-green-500 text-white px-3 py-1 rounded mt-2">Simpan</button>
    </form>
</x-app-layout>
