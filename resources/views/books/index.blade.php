<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">
                    📚 Books Collection
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Manage all your uploaded books
                </p>
            </div>

            <a href="{{ route('books.create') }}"
               class="bg-green-500 hover:bg-green-600 text-black px-5 py-3 rounded-xl font-semibold shadow-lg transition duration-200">

                + Add Book
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-100 py-8">

        <div class="max-w-7xl mx-auto px-6">

            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if($books->isEmpty())

                <div class="bg-white rounded-3xl shadow-lg p-16 text-center">

                    <h3 class="text-3xl font-bold text-gray-700 mb-2">
                        No Books Found
                    </h3>

                    <p class="text-gray-500">
                        Start by adding your first book.
                    </p>

                </div>

            @else

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    @foreach ($books as $book)

                        <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition duration-300 p-6 border border-gray-100">

                            {{-- BOOK HEADER --}}
                            <div class="flex items-start justify-between mb-4">

                                <div>
                                    <h3 class="text-2xl font-bold text-gray-800">
                                        {{ $book->title }}
                                    </h3>

                                    <p class="text-gray-500 mt-1">
                                        by {{ $book->author }}
                                    </p>
                                </div>

                            </div>

                            {{-- DESCRIPTION --}}
                            <p class="text-gray-600 mb-5">
                                {{ $book->description }}
                            </p>

                            {{-- OWNER --}}
                            @if(auth()->user()->role === 'admin')

                                <div class="mb-5">

                                    <span class="text-xs bg-purple-100 text-purple-700 px-3 py-1 rounded-full">
                                        Owner: {{ $book->user->name }}
                                    </span>

                                </div>

                            @endif

                            {{-- ACTION BUTTONS --}}
                            <div class="flex items-center gap-3 flex-wrap">

                                {{-- VIEW --}}
                                <a href="{{ route('books.show', $book) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow transition duration-200">

                                    View
                                </a>

                                {{-- EDIT --}}
                                @can('update', $book)

                                    <a href="{{ route('books.edit', $book) }}"
                                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow transition duration-200">

                                        Edit
                                    </a>

                                @endcan

                                {{-- DELETE --}}
                                @can('delete', $book)

                                    <form action="{{ route('books.destroy', $book) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this book?');">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow transition duration-200">

                                            Delete
                                        </button>

                                    </form>

                                @endcan

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

        </div>

    </div>
</x-app-layout>