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
            <h1 class="text-3xl font-semibold mb-3">Edit Pengguna</h1>
            <p class="text-sm">Silahkan perbarui data pengguna sesuai kebutuhan!</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg border py-8 px-8 mr-16">
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <!-- 1. Nama Depan & Belakang -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Nama Depan</label>
                        <input type="text" name="first_name" 
                            value="{{ old('first_name', $user->first_name) }}"
                            class="w-full p-2 border rounded-lg @error('first_name') border-red-500 @enderror" required>
                        @error('first_name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Nama Belakang</label>
                        <input type="text" name="last_name" 
                            value="{{ old('last_name', $user->last_name) }}"
                            class="w-full p-2 border rounded-lg @error('last_name') border-red-500 @enderror" required>
                        @error('last_name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" 
                        value="{{ old('email', $user->email) }}"
                        class="w-full p-2 border rounded-lg @error('email') border-red-500 @enderror" required>
                    @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 2. Jabatan & NIK/NIP -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Jabatan</label>
                        <select name="position" 
                            class="w-full p-2 border rounded-lg @error('position') border-red-500 @enderror" required>
                            <option value="">-- Pilih Jabatan --</option>
                            <option value="analis" {{ old('position', $user->position) == 'analis' ? 'selected' : '' }}>Analis</option>
                            <option value="supervisor" {{ old('position', $user->position) == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                            <option value="manager" {{ old('position', $user->position) == 'manager' ? 'selected' : '' }}>Manager</option>
                        </select>
                        @error('position')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">NIK / NIP</label>
                        <input type="text" name="nik" 
                            value="{{ old('nik', $user->nik) }}"
                            class="w-full p-2 border rounded-lg @error('nik') border-red-500 @enderror" required>
                        @error('nik')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- 3. Keterangan Jabatan -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Keterangan Jabatan</label>
                    <textarea name="desc" rows="3"
                        class="w-full p-2 border rounded-lg @error('desc') border-red-500 @enderror">{{ old('desc', $user->desc) }}</textarea>
                    @error('desc')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 4. Role -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Role</label>
                    <select name="role" class="w-full p-2 border rounded-lg @error('role') border-red-500 @enderror" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="analis" {{ old('role', $user->role) == 'analis' ? 'selected' : '' }}>Analis</option>
                        <option value="supervisor" {{ old('role', $user->role) == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                    </select>
                    @error('role')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 5. Password -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Password (kosongkan jika tidak ingin ubah)</label>
                    <input type="password" name="password" 
                        class="w-full p-2 border rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 6. Konfirmasi Password -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" 
                        class="w-full p-2 border rounded-lg">
                </div>

                <!-- Submit -->
                <div class="mt-6">
                    <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        @vite('resources/js/date.js')
    @endpush
</x-app-layout>
