<div class="bg-white border-b border-gray-100 h-full w-full flex items-center justify-end">
    <!-- Primary Navigation Menu -->
    <div class="flex w-full justify-between sm:justify-end">
        <!-- Hamburger -->
        <div class="mx-4 flex items-center sm:hidden">
            <button @click="sidebarOpen = ! sidebarOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                    :class="{'fixed z-20 bg-red-100': sidebarOpen, 'static z-5': ! sidebarOpen}">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': sidebarOpen, 'inline-flex': ! sidebarOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! sidebarOpen, 'inline-flex': sidebarOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Settings Dropdown -->
        <div class="flex items-center ml-6">
            <div class="hidden sm:block px-2">
                @foreach(\App\QuickiWiki::navigationMenu() as $navItem)
                    <x-nav-link :href="$navItem" :active="$navItem->isActive()" :extraAttributes="$navItem->getAttributes()">
                        {{ __($navItem->label()) }}
                    </x-nav-link>
                @endforeach
            </div>
            @auth
            @if(count(\App\QuickiWiki::navigationMenu()))
                <span role="presentation" class="hidden sm:block text-gray-300 select-none">|</span>
            @endif
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
            @endauth
        </div>
    </div>
</div>
