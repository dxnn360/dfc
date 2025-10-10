@props(['menus' => []])

<div x-data="{ 
    open: window.innerWidth >= 1024,
    isDesktop: window.innerWidth >= 1024
}" class="bg-white min-h-screen">
    <!-- Mobile Toggle Button -->
    <button 
        x-show="!isDesktop"
        @click="open = !open"
        class="fixed top-6 z-50 p-3 bg-white rounded-xl shadow-lg border-0 hover:shadow-xl transition-all duration-300 group"
    >
        <div class="relative w-6 h-6">
            <span :class="[
                'absolute left-0 w-6 h-0.5 bg-gray-700 transition-all duration-300',
                open ? 'top-3 rotate-45' : 'top-2'
            ]"></span>
            <span :class="[
                'absolute left-0 w-6 h-0.5 bg-gray-700 transition-all duration-300',
                open ? 'opacity-0' : 'top-3 opacity-100'
            ]"></span>
            <span :class="[
                'absolute left-0 w-6 h-0.5 bg-gray-700 transition-all duration-300',
                open ? 'top-3 -rotate-45' : 'top-4'
            ]"></span>
        </div>
    </button>

    <!-- Overlay -->
    <div 
        x-show="open && !isDesktop"
        @click="open = false"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm z-30 md:hidden transition-opacity duration-300"
    ></div>

    <!-- Sidebar -->
    <aside 
        x-show="open || isDesktop"
        :class="{
            'w-72': open,
            'w-20': !open && isDesktop
        }"
        class="fixed top-0 left-0 h-full bg-white border-r border-gray-100 flex flex-col shadow-xl z-40 transition-all duration-300"
    >
        <!-- Header -->
        <div class="flex items-center p-6 pb-4 border-b border-gray-100">
            <div class="flex items-center gap-3" :class="{ 'justify-center w-full': !open && isDesktop }">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-md">
                    <img src="/images/login.png" alt="Logo" class="w-6 h-6 filter brightness-0 invert">
                </div>
                <div x-show="open" class="flex-1">
                    <h1 class="font-bold text-gray-900">Forensic Lab</h1>
                    <p class="text-sm text-gray-500">Analyst Dashboard</p>
                </div>
            </div>
            
            <!-- Desktop Toggle -->
            <button 
                x-show="isDesktop"
                @click="open = !open"
                class="p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200"
            >
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          :d="open ? 'M15 19l-7-7 7-7' : 'M9 5l7 7-7 7'"/>
                </svg>
            </button>
        </div>

        <!-- User Info -->
        <div x-show="open" class="px-4 py-3 mx-3 my-4 bg-blue-50 rounded-xl border border-blue-100">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center text-white text-xs font-bold shadow-sm">
                    {{ substr(auth()->user()->name, 0, 2) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-gray-900 text-sm truncate">{{ auth()->user()->name }}</p>
                    <p class="text-gray-500 text-xs">Forensic Analyst</p>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-3 space-y-1 py-4">
            @foreach($menus as $menu)
                @php
                    $isActive = request()->fullUrlIs(url($menu['url'])) || request()->is(ltrim($menu['url'], '/').'*');
                $isHover = false;
                @endphp

                <a 
                    href="{{ $menu['url'] }}" 
                    class="group relative flex items-center gap-3 px-3 py-3 rounded-xl transition-all duration-200
                           {{ $isActive ? 
                               'bg-blue-500 text-white shadow-lg shadow-blue-500/25' : 
                               'text-gray-600 hover:bg-white hover:text-gray-900 hover:shadow-md hover:border hover:border-gray-100'
                           }}"
                    :class="{ 'justify-center': !open && isDesktop }"
                    x-data="{ isHover: false }"
                    @mouseenter="isHover = true"
                    @mouseleave="isHover = false"
                >
                    <!-- Active Indicator -->
                    <div x-show="{{ $isActive ? 'true' : 'false' }} && open" class="absolute -left-2 top-1/2 transform -translate-y-1/2 w-1 h-6 bg-blue-500 rounded-full"></div>

                    <!-- Icon -->
                    <div class="relative flex-shrink-0">
                        <div class="{{ $isActive ? 
                            'bg-white/20 p-2 rounded-lg' : 
                            'bg-gray-100 group-hover:bg-blue-100 p-2 rounded-lg transition-colors duration-200'
                        }}">
                            <img src="{{ $menu['icon'] }}" 
                                 alt="{{ $menu['label'] }}" 
                                 class="w-5 h-5 {{ $isActive ? 
                                     'filter brightness-0 invert' : 
                                     'group-hover:filter group-hover:brightness-0 group-hover:invert transition-all duration-200'
                                 }}">
                        </div>
                    </div>

                    <!-- Label -->
                    <span x-show="open" class="font-medium whitespace-nowrap transition-all duration-200">
                        {{ $menu['label'] }}
                    </span>

                    <!-- Tooltip for collapsed state -->
                    <div x-show="!open && isDesktop && isHover" 
                         class="absolute left-full ml-3 px-3 py-2 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap z-50 shadow-xl">
                        {{ $menu['label'] }}
                        <div class="absolute -left-1 top-1/2 transform -translate-y-1/2 w-2 h-2 bg-gray-900 rotate-45"></div>
                    </div>
                </a>
            @endforeach
        </nav>

        <!-- Logout Section -->
        <div class="p-4 border-t border-gray-100">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button 
                    type="submit" 
                    class="w-full flex items-center gap-3 px-3 py-3 rounded-xl text-gray-600 hover:bg-red-50 hover:text-red-600 transition-all duration-200 group"
                    :class="{ 'justify-center': !open && isDesktop }"
                >
                    <div class="p-2 rounded-lg bg-gray-100 group-hover:bg-red-100 transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <span x-show="open" class="font-medium">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main 
        :class="{
            'ml-72': open && isDesktop,
            'ml-20': !open && isDesktop,
            'ml-0': !isDesktop
        }"
        class="transition-all duration-300 min-h-screen bg-gradient-to-br from-white to-gray-50/50"
    >
        <div class="p-6 pt-20 md:pt-6">
            {{ $slot }}
        </div>
    </main>
</div>

<style>
/* Custom scrollbar */
aside nav::-webkit-scrollbar {
    width: 4px;
}

aside nav::-webkit-scrollbar-track {
    background: transparent;
}

aside nav::-webkit-scrollbar-thumb {
    background: #ffffffff;
    border-radius: 10px;
}

aside nav::-webkit-scrollbar-thumb:hover {
    background: #ffffffff;
}

/* Smooth transitions */
* {
    transition-property: color, background-color, border-color, transform, box-shadow;
    transition-duration: 200ms;
}
</style>