<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-800">
            📖 Book Details
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-100 py-10">
        <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-lg p-8">

            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                {{ $book->title }}
            </h1>

            <p class="text-gray-500 mb-6">
                by {{ $book->author }}
            </p>

            <div class="bg-gray-50 p-5 rounded-xl text-gray-700 mb-6">
                {{ $book->description }}
            </div>

            <div class="text-sm text-gray-500 mb-6">
                Added by: {{ $book->user->name ?? 'Unknown' }}
            </div>

            <a href="{{ route('books.index') }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl">
                ← Back
            </a>

        </div>
    </div>
</x-app-layout>