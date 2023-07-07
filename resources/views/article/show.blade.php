<x-app-layout>
    <div class="py-12 sm:py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <article class="p-6 text-gray-900">
                    <header class="flex justify-between">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $title }}
                        </h2>
                        
                        <div class="text-sm text-gray-500 flex items-start">
                            <a href="{{ route('articles.edit', $article) }}">
                                {{ __('Edit') }}
                            </a>

                            <x-dropdown>
                                <x-slot:trigger>
                                    <button class="ml-2 text-sm text-gray-500">
                                        <span class="sr-only">{{ __('More actions') }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5" role="presentation" title="{{ __('More actions') }}">
                                            <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                                        </svg>
                                    </button>
                                </x-slot:trigger>

                               <x-slot:content>
                                   <x-dropdown-link href="{{ route('articles.contributions', $article) }}">
                                       {{ __('Contributions') }}
                                      </x-dropdown-link>

                                   <x-dropdown-link href="{{ route('articles.destroy', $article) }}" onclick="event.preventDefault(); document.getElementById('delete-article-form').submit();">
                                       {{ __('Delete') }}
                                   </x-dropdown-link>

                                   <form id="delete-article-form" action="{{ route('articles.destroy', $article) }}" method="POST" class="hidden">
                                       @method('DELETE')
                                       @csrf
                                   </form>
                               </x-slot:content>
                            </x-dropdown>
                        </div>
                    </header>
                    <hr class="my-3">
                    <div class="prose max-w-full">
                        {{ $content }}
                    </div>
                </article>
            </div>
        </div>
    </div>
</x-app-layout>
