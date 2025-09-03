<x-app-layout>
    <h1 class="text-xl font-bold mb-3">Edit User</h1>

    <form method="POST" action="{{ route('users.update',$user) }}">
        @csrf @method('PUT')
        <div>Nama: <input type="text" name="name" value="{{ $user->name }}" required></div>
        <div>Email: <input type="email" name="email" value="{{ $user->email }}" required></div>
        <div>Password (kosongkan jika tidak diganti): 
            <input type="password" name="password">
        </div>
        <div>
            Role:
            <select name="role" required>
                @foreach($roles as $r)
                    <option value="{{ $r->name }}" @selected($user->hasRole($r->name))>
                        {{ ucfirst($r->name) }}
                    </option>
                @endforeach
            </select>
        </div>
        <button class="bg-blue-500 text-white px-3 py-1 rounded mt-2">Update</button>
    </form>
</x-app-layout>
