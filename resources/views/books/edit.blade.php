<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-800">
            Edit Book
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-100 py-10">
        <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-lg p-8">

            <form method="POST" action="{{ route('books.update', $book) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Title</label>
                    <input type="text" name="title"
                        value="{{ $book->title }}"
                        class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-yellow-200">
                </div>

                <!-- Author -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Author</label>
                    <input type="text" name="author"
                        value="{{ $book->author }}"
                        class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-yellow-200">
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-yellow-200">{{ $book->description }}</textarea>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3">
                    <a href="{{ route('books.index') }}"
                        class="px-5 py-2 rounded-xl bg-red-300 hover:bg-red-400 text-black-800 font-semibold">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-5 py-2 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-black font-semibold">
                        Update Book
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>