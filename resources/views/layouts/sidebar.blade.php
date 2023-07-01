<div class="bg-white border-b border-gray-100 h-full w-full">
    <!-- Primary Navigation Menu -->
    <div class="flex justify-between flex-col h-full">
        <!-- Logo -->
        <header class="flex items-center border-b p-2 min-h-[4rem]">
            <a href="{{ route('home') }}" class="flex items-center">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 px-2" />
                <strong class="text-lg">{{ config('app.name', 'Laravel') }}</strong>
            </a>
        </header>

        <!-- Navigation Links -->
        <nav class="h-full py-2">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>

            @auth
            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                {{ __('Profile') }}
            </x-responsive-nav-link>
            @endauth
        </nav>

        <!-- Footer -->
        <footer class="flex items-center border-t p-2 min-h-[4rem] text-sm text-center justify-center">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </div>
</div>
