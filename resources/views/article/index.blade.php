<x-app-layout>
    <div class="py-12 sm:py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <article class="p-6 text-gray-900">
                    <header class="flex justify-between">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('All Articles') }} <small>({{ $articles->count() }} {{ Str::plural('article', $articles->count()) }} total)</small>
                        </h2>

                        <div class="text-sm text-gray-500 flex items-start">
                            <a href="{{ route('articles.create') }}">
                                {{ __('Create new article') }}
                            </a>
                        </div>
                    </header>
                    <hr class="my-3">
                    <div class="prose max-w-full">
                        <ul class="list-disc list-inside">
                            @foreach($articles as $article)
                                <li>
                                    <a href="{{ route('articles.show', $article) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                        {{ $article->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </div>
</x-app-layout>
