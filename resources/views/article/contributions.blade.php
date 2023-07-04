<x-app-layout>
    <div class="py-12 sm:py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section class="p-6 text-gray-900">
                    <header class="flex justify-between">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Contributions for') }} "{{ $title }}"
                        </h2>

                        <div class="text-sm text-gray-500">
                            <a href="{{ route('articles.show', $article) }}">
                                {{ __('Go back') }}
                            </a>
                        </div>
                    </header>
                    <hr class="my-3">
                    <div>
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="text-left">{{ __('User') }}</th>
                                    <th class="text-left">{{ __('Date') }}</th>
                                    <th class="text-left">{{ __('Message') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($article->contributions as $contribution)
                                    <tr>
                                        <td class="border px-4 py-2"><x-link href="{{ route('users.show', $contribution->user) }}">{{ $contribution->user->name }}</x-link></td>
                                        <td class="border px-4 py-2"><time datetime="{{ $contribution->created_at }}">{{ $contribution->created_at->format('H:i, d F Y') }}</time></td>
                                        <td class="border px-4 py-2">{{ $contribution->message }} <small>({{ $contribution->diff() }})</small></td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
