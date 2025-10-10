@php
    use Carbon\Carbon;

    $supervisorCount = $users->filter(function($user) {
        return $user->hasRole('supervisor');
    })->count();
    
    $analisCount = $users->filter(function($user) {
        return $user->hasRole('analis');
    })->count();
    
    $adminCount = $users->filter(function($user) {
        return $user->hasRole('admin');
    })->count();
    
    $totalUsers = $users->count();
@endphp

<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Manajemen Pengguna</h1>
                        <p class="mt-2 text-gray-600">Kelola data pengguna dan akses sistem</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200">
                            Hi, {{ auth()->user()->name }}👋
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Supervisor Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-gray-900 mb-2">{{ $supervisorCount }}</p>
                            <h3 class="text-lg font-semibold text-gray-700">Supervisor</h3>
                            <p class="text-sm text-gray-500 mt-1">Pengguna dengan role supervisor</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center text-sm text-gray-600">
                            <div class="w-2 h-2 bg-purple-500 rounded-full mr-2"></div>
                            Bertugas memverifikasi dokumen
                        </div>
                    </div>
                </div>

                <!-- Analis Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-gray-900 mb-2">{{ $analisCount }}</p>
                            <h3 class="text-lg font-semibold text-gray-700">Analis</h3>
                            <p class="text-sm text-gray-500 mt-1">Pengguna dengan role analis</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center text-sm text-gray-600">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                            Bertugas membuat dokumen
                        </div>
                    </div>
                </div>

                <!-- Total Users & Add User Card -->
                <div onclick="window.location='{{ route('users.create') }}'" 
                     class="bg-white rounded-2xl shadow-sm border-2 border-dashed border-gray-300 p-6 hover:border-blue-500 hover:shadow-md transition-all duration-300 cursor-pointer group">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <p class="text-3xl font-bold text-gray-900 mb-2">{{ $totalUsers }}</p>
                            <h3 class="text-lg font-semibold text-gray-700">Total Pengguna</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                @if($adminCount > 0)
                                    +{{ $adminCount }} Admin
                                @endif
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-sm text-blue-600 font-medium">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Tambah Pengguna Baru
                            </div>
                            <div class="text-xs text-gray-500">
                                Klik untuk menambahkan
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Table Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Search Header -->
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="mb-4 sm:mb-0">
                            <h2 class="text-lg font-semibold text-gray-900">Daftar Pengguna</h2>
                            <p class="text-sm text-gray-600 mt-1">
                                Total {{ $totalUsers }} pengguna 
                                ({{ $supervisorCount }} Supervisor, {{ $analisCount }} Analis
                                @if($adminCount > 0)
                                    , {{ $adminCount }} Admin
                                @endif
                                )
                            </p>
                        </div>
                        <form method="GET" action="{{ route('users.index') }}" class="flex items-center space-x-3">
                            <div class="relative">
                                <input type="text" 
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Cari nama atau email..." 
                                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors w-64">
                                <svg class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ route('users.index') }}" class="px-3 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                                    Reset
                                </a>
                            @endif
                        </form>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                    No
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                    User
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                    Email
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                    Role
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($users as $u)
                            @php
                                $userRoles = $u->getRoleNames();
                                $isSupervisor = $userRoles->contains('supervisor');
                                $isAnalis = $userRoles->contains('analis');
                                $isAdmin = $userRoles->contains('admin');
                                
                                // Determine primary role for display
                                $primaryRole = 'User';
                                $roleColor = 'gray';
                                
                                if ($isAdmin) {
                                    $primaryRole = 'Admin';
                                    $roleColor = 'red';
                                } elseif ($isSupervisor) {
                                    $primaryRole = 'Supervisor';
                                    $roleColor = 'purple';
                                } elseif ($isAnalis) {
                                    $primaryRole = 'Analis';
                                    $roleColor = 'blue';
                                }
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-sm font-medium text-gray-600">
                                                {{ strtoupper(substr($u->name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-900">{{ $u->name }}</span>
                                            <p class="text-xs text-gray-500">Bergabung {{ $u->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $u->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col space-y-1">
                                        <!-- Primary Role Badge -->
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $roleColor === 'purple' ? 'bg-purple-100 text-purple-800' : 
                                               ($roleColor === 'blue' ? 'bg-blue-100 text-blue-800' :
                                               ($roleColor === 'red' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                            @if($roleColor === 'purple')
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                            </svg>
                                            @elseif($roleColor === 'blue')
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            @elseif($roleColor === 'red')
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            @endif
                                            {{ $primaryRole }}
                                        </span>
                                        
                                        <!-- Additional Roles (if any) -->
                                        @if($userRoles->count() > 1)
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($userRoles as $role)
                                                @if($role !== strtolower($primaryRole))
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-gray-100 text-gray-600">
                                                    {{ $role }}
                                                </span>
                                                @endif
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('users.edit', $u) }}"
                                           class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 text-xs font-medium">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('users.destroy', $u) }}" class="inline">
                                            @csrf @method('DELETE')
                                            <button onclick="return confirm('Yakin hapus user {{ $u->name }}?')"
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 text-xs font-medium">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                        </svg>
                                        <p class="text-gray-500 text-lg mb-2">
                                            @if(request('search'))
                                                Tidak ditemukan pengguna dengan kata kunci "{{ request('search') }}"
                                            @else
                                                Tidak ada data pengguna
                                            @endif
                                        </p>
                                        <p class="text-gray-400 text-sm">
                                            @if(request('search'))
                                                <a href="{{ route('users.index') }}" class="text-blue-600 hover:text-blue-700">Tampilkan semua pengguna</a>
                                            @else
                                                Pengguna yang terdaftar akan muncul di sini
                                            @endif
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination and Info -->
                @if($users->count() > 0)
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="mb-4 sm:mb-0">
                            <p class="text-sm text-gray-700">
                                Menampilkan <span class="font-semibold">{{ $users->firstItem() }}</span> - 
                                <span class="font-semibold">{{ $users->lastItem() }}</span> dari 
                                <span class="font-semibold">{{ $users->total() }}</span> pengguna
                            </p>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Set today's date in display
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const todayDisplay = new Date().toLocaleDateString('id-ID', options);
            
            // Auto focus search input if there's search query
            @if(request('search'))
                document.querySelector('input[name="search"]').focus();
            @endif
        });
    </script>
</x-app-layout>