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
            <h1 class="text-3xl font-semibold mb-3">Tambah Pengguna</h1>
            <p class="text-sm">Silahkan isi data pengguna baru sesuai dengan data yang diberikan!</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg border py-8 px-8 mr-16">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <!-- 1. Nama Depan & Belakang -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm mb-1">Nama Depan<span class="text-red-500">*</span></label>
                        <input type="text" name="first_name" placeholder="Contoh: Jean"
                            class="w-full p-2 border rounded-full @error('first_name') border-red-500 @enderror"
                            required>
                        @error('first_name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm mb-1">Nama Belakang<span class="text-red-500">*</span></label>
                        <input type="text" name="last_name" placeholder="Contoh: Valjean"
                            class="w-full p-2 border rounded-full @error('last_name') border-red-500 @enderror"
                            required>
                        @error('last_name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-sm mb-1">Email<span class="text-red-500">*</span></label>
                    <input type="email" name="email" placeholder="Contoh:@gmail.com"
                        class="w-full p-2 border rounded-full @error('email') border-red-500 @enderror" required>
                    @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <!-- 2. Jabatan & NIK/NIP -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm mb-1">Jabatan<span class="text-red-500">*</span></label>
                        <select name="position"
                            class="w-full p-2 border rounded-full @error('position') border-red-500 @enderror" required>
                            <option value="">-- Pilih Jabatan --</option>
                            <option value="analis" {{ old('position') == 'analis' ? 'selected' : '' }}>Analis</option>
                            <option value="supervisor" {{ old('position') == 'supervisor' ? 'selected' : '' }}>Supervisor
                            </option>
                            <option value="manager" {{ old('position') == 'manager' ? 'selected' : '' }}>Manager</option>
                        </select>
                        @error('position')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm mb-1">NIK / NIP</label>
                        <input type="text" name="nik" placeholder="Contoh: 1234567890"
                            class="w-full p-2 border rounded-full @error('nik') border-red-500 @enderror" required>
                        @error('nik')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- 3. Keterangan Jabatan -->
                <div class="mb-4">
                    <label class="block text-sm mb-1">Keterangan Jabatan<span class="text-red-500">*</span></label>
                    <textarea name="desc" rows="3"
                        class="w-full p-2 border rounded-xl @error('desc') border-red-500 @enderror">{{ old('desc') }}</textarea>
                    @error('desc')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 4. Role -->
                <div class="mb-4">
                    <label class="block text-sm mb-1">Role<span class="text-red-500">*</span></label>
                    <select name="role" class="w-full p-2 border rounded-full @error('role') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="analis" {{ old('role') == 'analis' ? 'selected' : '' }}>Analis</option>
                        <option value="supervisor" {{ old('role') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                    </select>
                    @error('role')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 5. Password -->
                <div class="mb-4">
                    <label class="block text-sm mb-1">Password</label>
                    <input type="password" name="password"
                        placeholder="Tuliskan password dengan kombinasi angka dan huruf"
                        class="w-full p-2 border rounded-full @error('password') border-red-500 @enderror" required>
                    @error('password')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 6. Konfirmasi Password -->
                <div class="mb-4">
                    <label class="block text-sm mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Tuliskan ulang password yang sama"
                        class="w-full p-2 border rounded-full" required>
                </div>

                <!-- Submit -->
                <div class="flex justify-end gap-2 mt-12 mb-4">
                    <a href="{{ route('admin.dashboard') }}"
                        class="bg-white text-[#C4C4C4]  text-center border-2 border-[#C4C4C4] px-12 rounded-full py-2 font-bold hover:text-gray-900 hover:bg-gray-400">
                        Batalkan
                    </a>
                    <button type="submit"
                        class="bg-[#00ABF1] text-white px-12 rounded-full py-2 font-bold hover:bg-blue-700 ">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        @vite('resources/js/date.js')
    @endpush
</x-app-layout>