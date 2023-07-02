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
                        <label for="title" class="block font-medium text-sm text-gray-700">Title</label>
                        <input type="text" name="title" id="title" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $article->title }}" />

                        <label for="content" class="block font-medium text-sm text-gray-700 mt-3">Content</label>
                        <textarea name="content" id="content" class="form-textarea rounded-md shadow-sm mt-1 block w-full" rows="10">{{ $article->content }}</textarea>

                        <div class="mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
