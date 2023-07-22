<x-app-layout>
    <div class="py-12 sm:py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header class="max-w-xl">
                    <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
                        {{ $user->name }}'s {{ __('Profile') }}
                    </h1>
                </header>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Contributions') }}
                    </h3>
                    @if ($user->contributions->count())
                        <hr class="my-3">
                        <div class="prose">
                            <table class="w-full">
                                <thead>
                                <tr>
                                    <th class="text-left">{{ __('Article') }}</th>
                                    <th class="text-left">{{ __('Date') }}</th>
                                    <th class="text-left">{{ __('Message') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($contributions as $contribution)
                                    <tr>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('articles.show', $contribution->article) }}">{{ $contribution->article->title }}</a>
                                        </td>
                                        <td class="border px-4 py-2">
                                            <time datetime="{{ $contribution->created_at }}">{{ $contribution->created_at->format('H:i, d F Y') }}</time>
                                        </td>
                                        <td class="border px-4 py-2">
                                            {{ $contribution->message }} <small>({{ $contribution->diff() }})</small>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="mt-4">
                            {{ $user->name }} has not contributed to any articles yet.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
