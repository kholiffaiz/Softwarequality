<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tweet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form action="{{ route('tweet.update', $tweet) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <textarea class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="content" rows="1" placeholder="leave your reply">{{ old('content') ?? $tweet->content }}</textarea>
                    <x-jet-input-error for="content" class="mt-2" />
                    <div class="flex justify-end">
                        <x-jet-button>Save</x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
