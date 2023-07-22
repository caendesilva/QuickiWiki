<x-app-layout>
    <div class="py-12 sm:py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section class="p-6 text-gray-900">
                    <header class="flex justify-between">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Creating a new article') }}
                        </h2>

                        <div class="text-sm text-gray-500">
                            <a href="{{ route('home') }}">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </header>
                    <hr class="my-3">
                    <form method="POST" action="{{ route('articles.store') }}">
                        @csrf
                        <x-input-label for="title">Title</x-input-label>
                        <x-text-input type="text" name="title" id="title" class="form-input mt-1 mb-3 block w-full" value="{{ old('title') }}" />

                        <x-input-label for="content">Content</x-input-label>
                        <x-textarea-input name="content" id="content" class="form-textarea mt-1 mb-3 block w-full" rows="10">{{ old('content') }}</x-textarea-input>

                        <div class="mt-4">
                            <x-secondary-button href="{{ route('home')  }}" class="mr-1">
                                {{ __('Cancel') }}
                            </x-secondary-button>
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
