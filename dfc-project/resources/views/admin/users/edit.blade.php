<x-app-layout>

    <div class="mr-8">
        <div class="flex justify-between">
            <div class="flex-1">
                <h1 class="text-sm text-black">Hi, {{ auth()->user()->name }}👋</h1>
            </div>
            <div class="flex-1">
                <h1 class="text-sm text-black text-right" id="today"></h1>
            </div>
        </div>

        <div class="my-6">
            <h1 class="text-3xl font-semibold mb-3">Edit Pengguna</h1>
            <p class="text-sm">Silahkan isi data pengguna baru sesuai dengan data yang diberikan!</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg border py-8 px-8 mr-16">
            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf @method('PUT')
                <div class="mb-4">
                    <p class="mb-1 text-[#3C4B64]">Nama</p>
                    <input type="text" name="name" value="{{ $user->name }}" class="rounded-full border-[#3C4B64]" required>
                </div>
                <div class="mb-4">
                    <p class="mb-1 text-[#3C4B64]">Email</p> 
                    <input type="email" name="email" value="{{ $user->email }}" class="rounded-full border-[#3C4B64] w-full" required>
                </div>
                <div class="mb-4">
                    <p class="mb-1 text-[#3C4B64]">Role</p>
                    <select name="role" class="rounded-full border-[#3C4B64] w-full" required>
                        @foreach($roles as $r)
                            <option value="{{ $r->name }}" @selected($user->hasRole($r->name))>
                                {{ ucfirst($r->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <p class="mb-1 text-[#3C4B64]">Password (Kosongkan jika tidak ingin mengubah)</p>
                    <input type="password" name="password" class="rounded-full border-[#3C4B64] w-full">
                </div>
                
                <div class="flex justify-end">
                    <a href="{{ route('users.index') }}" class="bg-white text-[#C4C4C4] border-2 border-[#C4C4C4] px-8 rounded-full py-2 mt-2 font-bold mr-4 hover:text-gray-900 hover:bg-gray-400">Batalkan</a>
                    <button class="bg-[#00ABF1] text-white px-8 rounded-full py-2 mt-2 font-bold hover:bg-blue-800">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        @vite('resources/js/date.js')
    @endpush
</x-app-layout>