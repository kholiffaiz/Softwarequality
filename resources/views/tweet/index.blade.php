<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tweets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h1 class="text-2xl font-bold">Share your tweet</h1>

                <form action="{{ route('tweet.store') }}" method="POST">
                    @csrf
                    <textarea class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="content" rows="2" placeholder="tweet a tweet"></textarea>
                    <x-jet-input-error for="content" class="mt-2" />
                    <div class="flex justify-end">
                        <x-jet-button>Tweet</x-jet-button>
                    </div>
                </form>
            </div>

            <div class="mt-4">
                @forelse($tweets as $tweet)
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 my-4">
                        <div class="flex justify-between">
                            <span class="font-bold">{{ $tweet->user->name }}</span>
                            <span class="text-gray-500">{{ $tweet->created_at->diffForHumans() }}</span>
                        </div>
                        <span class="block">{{ $tweet->content }}</span>
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('tweet.edit', $tweet) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition bg-yellow-500">Edit</a>
                            <form action="{{ route('tweet.destroy', $tweet) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-jet-button type="submit" class="bg-red-500 hover:bg-red-600">Delete</x-jet-button>
                            </form>
                        </div>
                        <div class="border border-gray-100 my-2"></div>
                        <div class="flex justify-center">
                            <a href="{{ route('tweet.show', $tweet) }}" class="hover:text-blue-400">Comment ( {{ $tweet->comments->count() }} )</a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 my-4">
                        <div class="flex justify-between">
                            No tweet at this moment.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
