<x-app-layout>
    <div class="py-12 sm:py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <article class="p-6 text-gray-900">
                    <header>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $title }}
                        </h2>
                    </header>
                    {{ $content }}
                </article>
            </div>
        </div>
    </div>
</x-app-layout>
