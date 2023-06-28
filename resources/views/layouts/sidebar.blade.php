<div class="bg-white border-b border-gray-100 h-full w-full">
    <!-- Primary Navigation Menu -->
    <div class="flex justify-between flex-col h-full">
        <!-- Logo -->
        <header class="flex items-center border-b p-2 min-h-[4rem]">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 px-2" />
                <strong class="text-lg">{{ config('app.name', 'Laravel') }}</strong>
            </a>
        </header>

        <!-- Navigation Links -->
        <nav class="h-full">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                {{ __('Profile') }}
            </x-responsive-nav-link>
        </nav>

        <!-- Footer -->
        <footer class="flex items-center border-t p-2 min-h-[4rem] text-sm text-center justify-center">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </div>
</div>
