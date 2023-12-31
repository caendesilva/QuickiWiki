<div class="bg-white border-b border-gray-100 h-full w-full">
    <!-- Primary Navigation Menu -->
    <div class="flex justify-between flex-col h-full">
        <!-- Logo -->
        <header class="flex items-center border-b p-2 min-h-[4rem]">
            <a href="{{ route('home') }}" class="flex items-center">
                <x-application-logo class="block h-9 w-auto opacity-75 px-2" />
                <strong class="text-lg">{{ config('app.name', 'Laravel') }}</strong>
            </a>
        </header>

        <!-- Navigation Links -->
        <nav class="h-full py-2 flex flex-col">
            @foreach(\App\QuickiWiki::sidebarMenu() as $navItem)
                @if($navItem->label() === '[[ Divider ]]')
                    <hr class="border-gray-200 my-2">
                    @continue
                @endif
                <x-responsive-nav-link :href="$navItem->resolve()" :active="$navItem->isActive()" :extraAttributes="$navItem->getAttributes()">
                    {{ __($navItem->label()) }}
                </x-responsive-nav-link>
            @endforeach
        </nav>

        <!-- Footer -->
        <footer class="flex items-center border-t p-2 min-h-[4rem] text-sm text-center justify-center prose">
            {!! Str::inlineMarkdown(WikiSettings::footerText()) !!}
        </footer>
    </div>
</div>
