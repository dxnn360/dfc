@php
    $menus = [];

    if(auth()->check()) {
        if(auth()->user()->hasRole('admin')) {
            $menus = [
                ['label' => 'Dashboard', 'url' => route('admin.dashboard'), 'icon' => asset('images/icons/dashboard.png')],
                ['label' => 'Pengguna', 'url' => route('users.index'), 'icon' => asset('images/icons/user.png')],
                ['label' => 'Pengaturan', 'url' => route('profile.edit'), 'icon' => asset('images/icons/setting.png')],
            ];
        } elseif(auth()->user()->hasRole('analis')) {
            $menus = [
                ['label' => 'Dashboard', 'url' => route('analis.dashboard'), 'icon' => asset('images/icons/dashboard.png')],
                ['label' => 'Dokumen', 'url' => route('analis.document'), 'icon' => asset('images/icons/document.png')],
                ['label' => 'Pengaturan', 'url' => route('profile.edit'), 'icon' => asset('images/icons/setting.png')],
            ];
        } elseif(auth()->user()->hasRole('supervisor')) {
            $menus = [
                ['label' => 'Dashboard', 'url' => route('supervisor.dashboard'), 'icon' => asset('images/icons/dashboard.png')],
                ['label' => 'Dokumen', 'url' => route('supervisor.document'), 'icon' => asset('images/icons/document.png')],
                ['label' => 'Pengaturan', 'url' => '#', 'icon' => asset('images/icons/setting.png')],
            ];
        }
    }
@endphp

<div class="flex">
    <x-sidebar :menus="$menus"/>
    <main class="flex-1 p-6">
        {{ $slot }}
    </main>
</div>
