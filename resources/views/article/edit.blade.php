<x-app-layout>
    <div class="py-12 sm:py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section class="p-6 text-gray-900">
                    <header class="flex justify-between">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Editing') }} "{{ $title }}"
                        </h2>

                        <div class="text-sm text-gray-500">
                            <a href="{{ route('articles.show', $article) }}">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </header>
                    <hr class="my-3">
                    <form method="POST" action="{{ route('articles.update', $article) }}">
                        @method('PUT')
                        @csrf
                        <x-input-label for="title">Title</x-input-label>
                        <x-text-input type="text" name="title" id="title" class="form-input mt-1 mb-3 block w-full" value="{{ $article->title }}" />

                        <x-input-label for="content">Content</x-input-label>
                        <x-textarea-input name="content" id="content" class="form-textarea mt-1 mb-3 block w-full" rows="10">{{ $article->content }}</x-textarea-input>

                        <div class="mt-4">
                            <x-primary-button type="submit">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
