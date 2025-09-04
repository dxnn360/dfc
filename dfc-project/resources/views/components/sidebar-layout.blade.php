@php
    $menus = [];

    if(auth()->check()) {
        if(auth()->user()->hasRole('admin')) {
            $menus = [
                ['label' => 'Dashboard', 'url' => route('admin.dashboard'), 'icon' => 'home'],
                ['label' => 'Pengguna', 'url' => route('users.index'), 'icon' => 'users'],
                ['label' => 'Pengaturan', 'url' => '#', 'icon' => 'document-text'],
            ];
        } elseif(auth()->user()->hasRole('analis')) {
            $menus = [
                ['label' => 'Dashboard', 'url' => route('analis.dashboard'), 'icon' => 'home'],
                ['label' => 'Dokumen', 'url' => route('analis.document'), 'icon' => 'document-text'],
                ['label' => 'Pengaturan', 'url' => '#', 'icon' => 'clipboard-document'],
            ];
        } elseif(auth()->user()->hasRole('supervisor')) {
            $menus = [
                ['label' => 'Dashboard', 'url' => route('supervisor.dashboard'), 'icon' => 'home'],
                ['label' => 'Dokumen', 'url' => route('supervisor.document'), 'icon' => 'check-badge'],
                ['label' => 'Pengaturan', 'url' => '#', 'icon' => 'archive-box'],
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
