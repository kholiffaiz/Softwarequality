<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tweets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="my-4">
                    <div class="flex justify-between">
                        <span class="font-bold text-2xl">{{ $tweet->user->name }}</span>
                        <span class="text-gray-500">{{ $tweet->created_at->diffForHumans() }}</span>
                    </div>
                    <span class="block">{{ $tweet->content }}</span>
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('tweet.edit', $tweet) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition bg-yellow-500">Edit</a>
                        <x-jet-button class="bg-red-500 hover:bg-red-600">Delete</x-jet-button>
                    </div>
                </div>

                <form action="{{ route('comment.store', $tweet) }}" method="POST">
                    @csrf
                    <textarea class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="content" rows="1" placeholder="leave your reply"></textarea>
                    <x-jet-input-error for="content" class="mt-2" />
                    <div class="flex justify-end">
                        <x-jet-button>Reply</x-jet-button>
                    </div>
                </form>
            </div>

            <div class="mt-4">
                <h1 class="font-bold text-2xl">Comments</h1>
                @forelse($tweet->comments as $comment)
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 my-4">
                        <div class="flex justify-between">
                            <span class="font-bold">{{ $comment->user->name }}</span>
                            <span class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <span class="block">{{ $comment->content }}</span>
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('comment.edit', [$tweet, $comment]) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition bg-yellow-500">Edit</a>
                            <form action="{{ route('comment.destroy', [$tweet, $comment]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-jet-button type="submit" class="bg-red-500 hover:bg-red-600" id="delete-comment-{{$comment->id}}">Delete</x-jet-button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 my-4">
                        <div class="flex justify-between">
                            No comment for this tweet.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
