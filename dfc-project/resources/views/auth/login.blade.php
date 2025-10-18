<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-black mb-2">Sign In</h1>
        <p class="text-sm text-black">Enter your credentials to access your account</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Username')" class="text-sm font-medium text-neutral-700 mb-2 block" />
            <x-text-input id="email" 
                class="block w-full px-4 py-3 text-sm bg-neutral-50 border border-neutral-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-neutral-900 focus:border-transparent transition-all duration-200" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username" 
                placeholder="username@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-neutral-700 mb-2 block" />
            <x-text-input id="password" 
                class="block w-full px-4 py-3 text-sm bg-neutral-50 border border-neutral-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-neutral-900 focus:border-transparent transition-all duration-200"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
                placeholder="Enter your password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" 
                    type="checkbox" 
                    class="w-4 h-4 rounded-md border-neutral-300 text-neutral-900 focus:ring-2 focus:ring-neutral-900 focus:ring-offset-0 transition" 
                    name="remember">
                <span class="ml-2 text-sm text-neutral-600 group-hover:text-neutral-900 transition">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-neutral-600 hover:text-neutral-900 font-medium transition" 
                   href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-3 bg-neutral-900 hover:bg-neutral-800 focus:bg-neutral-800 active:bg-neutral-950 text-white font-medium rounded-xl transition-all duration-200 shadow-sm hover:shadow-md">
                {{ __('Sign In') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Additional Info -->
    <div class="mt-8 pt-6 border-t border-neutral-100 text-center">
        <p class="text-xs text-neutral-500">
            Protected by advanced security measures
        </p>
    </div>
</x-guest-layout>