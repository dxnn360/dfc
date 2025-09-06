<x-app-layout>
    {{-- Header atas: sapaan dan tanggal --}}
    <div class="flex items-center justify-between px-6 py-4 ml-2 mr-8 bg-white shadow-sm sm:rounded-lg">
        <h1 class="text-base font-medium text-gray-800">
            Hi, {{ auth()->user()->name }} 👋
        </h1>
        <h1 class="text-base font-medium text-gray-800" id="today"></h1>
    </div>

    {{-- Slot judul halaman --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    {{-- Konten utama --}}
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            {{-- Update Profile --}}
            <div class="p-6 bg-white shadow rounded-2xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Update Password --}}
            <div class="p-6 bg-white shadow rounded-2xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete Account --}}
            <div class="p-6 bg-white shadow rounded-2xl">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        @vite('resources/js/date.js')
    @endpush
</x-app-layout>
