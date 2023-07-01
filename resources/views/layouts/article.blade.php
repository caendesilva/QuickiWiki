<x-app-layout>
    <div class="py-12 sm:py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <article class="p-6 text-gray-900">
                    <header class="flex justify-between">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $title }}
                        </h2>
                        
                        <div class="text-sm text-gray-500">
                            <a href="{{ route('articles.edit', $article) }}">
                                {{ __('Edit') }}
                            </a>
                        </div>
                    </header>
                    <hr class="my-3">
                    <div>
                        {{ $content }}
                    </div>
                </article>
            </div>
        </div>
    </div>
</x-app-layout>
