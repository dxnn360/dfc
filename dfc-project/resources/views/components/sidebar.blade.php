@props(['menus' => []])

<div x-data="{ open: window.innerWidth >= 768 }" class="bg-white min-h-screen">
    <!-- Overlay (mobile) -->
    <div 
        x-show="open && window.innerWidth < 768"
        @click="open = false"
        class="fixed inset-0 bg-black/50 z-30 md:hidden"
    ></div>

    <!-- Sidebar -->
    <aside 
        :class="{
            'w-64': open && window.innerWidth >= 768, 
            'w-20': !open && window.innerWidth >= 768,
            'w-64': open && window.innerWidth < 768,
            'hidden': !open && window.innerWidth < 768
        }"
        class="fixed top-0 left-0 h-screen bg-white text-black flex flex-col transition-all duration-300 shadow-xl z-40"
    >
        <!-- Header -->
        <div class="flex items-center justify-between px-4 pt-4 pb-2">
            <span x-show="open" x-transition class="text-lg font-bold">
                <img src="/images/login.png" alt="Logo" class="w-32 md:w-40 h-auto mx-auto">
            </span>
            <button 
                @click="open = !open"
                class="p-2 rounded hover:bg-gray-200"
            >
                <svg xmlns="http://www.w3.org/2000/svg" 
                     fill="none" viewBox="0 0 24 24" 
                     stroke-width="1.5" stroke="currentColor" 
                     class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M3.75 5.25h16.5m-16.5 6.75h16.5m-16.5 6.75h16.5" />
                </svg>
            </button>
        </div>

        <!-- Menu -->
        <nav class="flex-1 px-3 space-y-2 py-4 overflow-y-auto">
            @foreach($menus as $menu)
                @php
                    $isActive = request()->fullUrlIs(url($menu['url'])) || request()->is(ltrim($menu['url'], '/').'*');
                @endphp

                <a href="{{ $menu['url'] }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition 
                          hover:bg-[#00ABF1] 
                          {{ $isActive ? 'bg-[#00ABF1] text-white' : 'text-gray-700' }}">
                    
                    {{-- Icon --}}
                    <img src="{{ $menu['icon'] }}" 
                         alt="{{ $menu['label'] }} icon" 
                         class="w-6 h-6 shrink-0 {{ $isActive ? 'filter brightness-0 invert' : '' }}">

                    {{-- Label hanya muncul kalau open --}}
                    <span x-show="open" x-transition class="whitespace-nowrap">
                        {{ $menu['label'] }}
                    </span>
                </a>
            @endforeach
        </nav>

        <!-- Logout (selalu di bawah) -->
        <div class="p-4 mt-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" 
                        class="w-full flex items-center justify-center gap-3 px-4 py-3 rounded-xl bg-red-600 text-white hover:bg-red-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M18 12H9m9 0l-3-3m3 3l-3 3"/>
                    </svg>
                    <span x-show="open" x-transition>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main 
        :class="{
            'ml-64': open && window.innerWidth >= 768,
            'ml-20': !open && window.innerWidth >= 768,
            'ml-0': window.innerWidth < 768
        }"
        class="transition-all duration-300"
    >
        {{ $slot }}
    </main>
</div>
