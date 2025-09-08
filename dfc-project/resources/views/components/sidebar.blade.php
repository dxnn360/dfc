@props(['menus' => []])

<div x-data="{ open: false }" class="bg-white min-h-screen overflow-x-hidden">
    <!-- Toggle Button for Small/Medium Screens (Fixed Position) -->
    <button 
        @click="open = !open"
        class="fixed top-4 left-4 z-50 p-2 bg-white rounded-lg shadow-lg border md:hidden hover:bg-gray-50"
    >
        <svg xmlns="http://www.w3.org/2000/svg" 
             fill="none" viewBox="0 0 24 24" 
             stroke-width="1.5" stroke="currentColor" 
             class="w-6 h-6 text-gray-700">
          <path stroke-linecap="round" stroke-linejoin="round" 
                d="M3.75 5.25h16.5m-16.5 6.75h16.5m-16.5 6.75h16.5" />
        </svg>
    </button>

    <!-- Overlay (mobile and tablet) -->
    <div 
        x-show="open"
        @click="open = false"
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/50 z-30 md:hidden"
    ></div>

    <!-- Sidebar -->
    <aside 
        x-show="open || window.innerWidth >= 1024"
        x-init="
            $watch('open', value => {
                if (window.innerWidth >= 1024) {
                    open = true;
                }
            });
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    open = true;
                } else if (window.innerWidth < 768) {
                    // Keep current state for mobile
                }
            });
            if (window.innerWidth >= 1024) {
                open = true;
            }
        "
        :class="{
            'w-64': open && window.innerWidth >= 1024, 
            'w-20': !open && window.innerWidth >= 1024,
            'w-64': window.innerWidth < 1024
        }"
        x-transition:enter="transition-transform ease-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition-transform ease-in duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed top-0 left-0 h-full bg-white text-black flex flex-col shadow-xl z-40"
    >
        <!-- Header -->
        <div class="flex items-center justify-between px-4 pt-4 pb-2">
            <span x-show="open || window.innerWidth < 1024" x-transition class="text-lg font-bold">
                <img src="/images/login.png" alt="Logo" class="w-32 md:w-40 h-auto mx-auto">
            </span>
            
            <!-- Toggle button (visible on desktop only) -->
            <button 
                @click="open = !open"
                class="p-2 rounded hover:bg-gray-200 hidden lg:block"
            >
                <svg xmlns="http://www.w3.org/2000/svg" 
                     fill="none" viewBox="0 0 24 24" 
                     stroke-width="1.5" stroke="currentColor" 
                     class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M3.75 5.25h16.5m-16.5 6.75h16.5m-16.5 6.75h16.5" />
                </svg>
            </button>

            <!-- Close button (visible on mobile/tablet only) -->
            <button 
                @click="open = false"
                class="p-2 rounded hover:bg-gray-200 lg:hidden"
            >
                <svg xmlns="http://www.w3.org/2000/svg" 
                     fill="none" viewBox="0 0 24 24" 
                     stroke-width="1.5" stroke="currentColor" 
                     class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M6 18L18 6M6 6l12 12" />
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
                          hover:bg-[#00ABF1] hover:text-white
                          {{ $isActive ? 'bg-[#00ABF1] text-white' : 'text-gray-700' }}">
                    
                    {{-- Icon --}}
                    <img src="{{ $menu['icon'] }}" 
                         alt="{{ $menu['label'] }} icon" 
                         class="w-6 h-6 shrink-0 {{ $isActive ? 'filter brightness-0 invert' : '' }} hover-invert">

                    {{-- Label --}}
                    <span x-show="open || window.innerWidth < 1024" x-transition class="whitespace-nowrap">
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
                    <span x-show="open || window.innerWidth < 1024" x-transition>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main 
        :class="{
            'ml-64': (open || window.innerWidth < 1024) && window.innerWidth >= 1024,
            'ml-20': !open && window.innerWidth >= 1024,
            'ml-0': window.innerWidth < 1024
        }"
        class="transition-all duration-300 min-h-screen"
    >
        <!-- Content padding for mobile toggle button -->
        <div class="pt-16 md:pt-0">
            {{ $slot }}
        </div>
    </main>
</div>

<style>
.hover-invert {
    transition: filter 0.3s ease;
}
a:hover .hover-invert {
    filter: brightness(0) invert(1);
}
</style>