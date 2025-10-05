<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                        No
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                        Judul Laporan
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                        Status
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($laporan as $i => $item)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $i+1 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                        {{ $item->nomor_surat }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                            {{ $item->status === 'approved' ? 'bg-green-100 text-green-800 border border-green-200' : 
                               ($item->status === 'rejected' ? 'bg-red-100 text-red-800 border border-red-200' : 
                               'bg-yellow-100 text-yellow-800 border border-yellow-200') }}">
                            <span class="w-2 h-2 rounded-full mr-2
                                {{ $item->status === 'approved' ? 'bg-green-500' : 
                                   ($item->status === 'rejected' ? 'bg-red-500' : 'bg-yellow-500') }}">
                            </span>
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center gap-2">
                            <!-- Detail Button -->
                            <a href="{{ route('supervisor.laporan.detail', $item->id) }}" 
                               class="inline-flex items-center px-3 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors duration-200 border border-blue-200 text-sm font-medium">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Detail
                            </a>

                            <!-- ACC Button -->
                            <form action="{{ route('supervisor.laporan.approve', $item->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="inline-flex items-center px-3 py-2 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition-colors duration-200 border border-green-200 text-sm font-medium {{ $item->status === 'approved' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ $item->status === 'approved' ? 'disabled' : '' }}>
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    ACC
                                </button>
                            </form>

                            <!-- Revisi Button with Modal -->
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = true"
                                        class="inline-flex items-center px-3 py-2 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors duration-200 border border-red-200 text-sm font-medium {{ $item->status === 'rejected' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ $item->status === 'rejected' ? 'disabled' : '' }}>
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                    </svg>
                                    Revisi
                                </button>

                                <!-- Modal -->
                                <div x-show="open" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 transform scale-95"
                                     x-transition:enter-end="opacity-100 transform scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 transform scale-100"
                                     x-transition:leave-end="opacity-0 transform scale-95"
                                     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
                                     x-cloak>
                                    <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-6" @click.away="open = false">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Berikan Catatan Revisi Laporan</h3>
                                        <form action="{{ route('supervisor.laporan.reject', $item->id) }}" method="POST">
                                            @csrf
                                            <textarea name="catatan_supervisor" 
                                                      placeholder="Masukkan catatan revisi untuk laporan pemeriksaan..."
                                                      class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors resize-none"
                                                      rows="4"
                                                      required></textarea>
                                            <div class="flex justify-end gap-3 mt-4">
                                                <button type="button" 
                                                        @click="open = false"
                                                        class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                                                    Batal
                                                </button>
                                                <button type="submit" 
                                                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                                                    Kirim Revisi
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Empty State -->
    @if($laporan->count() === 0)
    <div class="text-center py-12">
        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        <p class="text-gray-500 text-lg">Tidak ada data laporan pemeriksaan</p>
    </div>
    @endif
</div>

<style>
    [x-cloak] { display: none !important; }
</style>