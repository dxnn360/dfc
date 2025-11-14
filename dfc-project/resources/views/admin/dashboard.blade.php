@php
    use Carbon\Carbon;

    $templateInfo = [
        'surat_tugas' => [
            'title' => 'Surat Tugas Digital',
            'icon' => '📄',
            'color' => 'blue'
        ],
        'surat_pengantar' => [
            'title' => 'Surat Pengantar Digital',
            'icon' => '📨',
            'color' => 'green'
        ],
        'laporan_penyelidikan' => [
            'title' => 'Laporan Penyelidikan Digital',
            'icon' => '🔍',
            'color' => 'purple'
        ],
    ];
@endphp

<x-app-layout>
    <div class="min-h-screen bg-white py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">Dashboard Admin</h1>
                        <p class="mt-2 text-slate-600">Kelola template dokumen dan pengguna sistem</p>
                    </div>
                    <div class="mt-4 sm:mt-0 flex items-center gap-4">
                        <div class="text-sm text-slate-500 bg-white px-4 py-2 rounded-xl shadow-sm border border-slate-200">
                            Hi, {{ auth()->user()->name }} 👋
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <!-- Template Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-slate-900 mb-2">3</p>
                            <h3 class="text-lg font-semibold text-slate-700">Template</h3>
                            <p class="text-sm text-slate-500 mt-1">Total template aktif</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                            <span class="text-2xl">📄</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <div class="flex items-center text-sm text-slate-600">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                            Semua template tersedia
                        </div>
                    </div>
                </div>

                <!-- Users Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-slate-900 mb-2">{{{ $totalUsers }}}</p>
                            <h3 class="text-lg font-semibold text-slate-700">Pengguna</h3>
                            <p class="text-sm text-slate-500 mt-1">Total pengguna terdaftar</p>
                        </div>
                        <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                            <span class="text-2xl">👥</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <div class="flex items-center text-sm text-slate-600">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                            Sistem aktif
                        </div>
                    </div>
                </div>

                <!-- Add User Card -->
                <div class="bg-white rounded-2xl shadow-sm border-2 border-dashed border-slate-300 p-6 hover:border-blue-500 hover:shadow-md transition-all duration-300 cursor-pointer group">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('users.create') }}">
                            <h3 class="text-lg font-semibold text-slate-700 group-hover:text-blue-600 transition-colors">Tambah Pengguna</h3>
                            <p class="text-sm text-slate-500 mt-1">Registrasi pengguna baru</p>
                        </a>
                        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                            <span class="text-2xl group-hover:scale-110 transition-transform">➕</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <div class="flex items-center text-sm text-blue-600 font-medium">
                            Klik untuk menambahkan
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                <!-- Template Documents Section -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-slate-900">Template Dokumen</h2>
                        <span class="text-sm text-slate-500 bg-slate-100 px-3 py-1 rounded-full font-medium">
                            {{ count($templateInfo) }} Template
                        </span>
                    </div>
                    
                    <div class="space-y-4">
                        @foreach ($templateInfo as $type => $info)
                        @php
                            $colorClasses = [
                                'blue' => 'border-blue-200 bg-blue-50 hover:bg-blue-100',
                                'green' => 'border-green-200 bg-green-50 hover:bg-green-100', 
                                'purple' => 'border-purple-200 bg-purple-50 hover:bg-purple-100'
                            ];
                            $colorIcons = [
                                'blue' => 'text-blue-600',
                                'green' => 'text-green-600',
                                'purple' => 'text-purple-600'
                            ];
                        @endphp
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-all duration-300 {{ $colorClasses[$info['color']] }}">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm border border-slate-200">
                                        <span class="text-2xl {{ $colorIcons[$info['color']] }}">{{ $info['icon'] }}</span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-slate-900">{{ $info['title'] }}</h3>
                                        <p class="text-sm text-slate-600 mt-1">
                                            <span class="font-medium">Terakhir Diperbarui:</span>
                                            @if(isset($templates[$type]))
                                                {{ Carbon::parse($templates[$type]->updated_at)->translatedFormat('d F Y H:i') }}
                                            @else
                                                <span class="text-orange-600">Belum pernah diatur</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <a href="{{ route('templates.edit', $type) }}"
                                    class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 hover:border-slate-400 transition-all duration-200 font-medium text-sm shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit Template
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Users Section -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-slate-900">Pengguna Terbaru</h2>
                        <a href="{{ route('users.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1">
                            Lihat Semua
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                    
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-slate-50 border-b border-slate-200">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">
                                            User
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">
                                            Role
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-slate-200">
                                    @foreach($users as $u)
                                    <tr class="hover:bg-slate-50 transition-colors duration-150">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center mr-3">
                                                    <span class="text-sm font-medium text-slate-600">
                                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-slate-900">{{ $u->name }}</p>
                                                    <p class="text-xs text-slate-500">ID: {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $u->roles->pluck('name')->implode(', ') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('users.edit', $u) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-white border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 hover:border-slate-400 transition-colors duration-200 text-xs font-medium shadow-sm">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('users.destroy', $u) }}" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button onclick="return confirm('Yakin hapus user ini?')"
                                                        class="inline-flex items-center px-3 py-1.5 bg-white border border-red-300 text-red-700 rounded-lg hover:bg-red-50 hover:border-red-400 transition-colors duration-200 text-xs font-medium shadow-sm">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Empty State -->
                        @if($users->count() === 0)
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl">👥</span>
                            </div>
                            <p class="text-slate-500 text-lg">Tidak ada data pengguna</p>
                            <p class="text-slate-400 text-sm mt-1">Pengguna yang terdaftar akan muncul di sini</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Set today's date in display
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const todayDisplay = new Date().toLocaleDateString('id-ID', options);
        });
    </script>
</x-app-layout>