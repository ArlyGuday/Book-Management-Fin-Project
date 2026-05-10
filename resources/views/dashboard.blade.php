<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">
                    📚 Book Management System
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Dashboard Overview
                </p>
            </div>

            <div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold
                    {{ auth()->user()->role === 'admin'
                        ? 'bg-red-100 text-red-700'
                        : 'bg-blue-100 text-blue-700' }}">
                    {{ strtoupper(auth()->user()->role) }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen mt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- TOP CARD --}}
            <div class="bg-gradient-to-r
                {{ auth()->user()->role === 'admin'
                    ? 'from-sky-500 to-indigo-700'
                    : 'from-blue-500 to-indigo-600' }}
                rounded-2xl shadow-xl p-8 text-black mb-8">

                <h3 class="text-4xl font-bold mb-2">
                    Hello, {{ auth()->user()->name }} 
                </h3>

                <p class="opacity-90 text-lg">
                    @if(auth()->user()->role === 'admin')
                        Manage users and monitor the entire book system.
                    @else
                        Manage your personal book collection easily.
                    @endif
                </p>
            </div>

            {{-- ADMIN STATS --}}
            @if(auth()->user()->role === 'admin')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">
                                    Total Users
                                </p>

                                <h3 class="text-4xl font-bold text-gray-800 mt-2">
                                    {{ $totalUsers ?? 0 }}
                                </h3>
                            </div>

                            <div class="text-5xl">
                                👥
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">
                                    Total Books
                                </p>

                                <h3 class="text-4xl font-bold text-gray-800 mt-2">
                                    {{ $totalBooks ?? 0 }}
                                </h3>
                            </div>

                            <div class="text-5xl">
                                📚
                            </div>
                        </div>
                    </div>

                </div>

                {{-- USERS --}}
                <div class="bg-white rounded-2xl shadow-lg mb-8">

                    <div class="border-b px-6 py-4">
                        <h3 class="text-2xl font-bold text-gray-800">
                            Registered Users
                        </h3>
                    </div>

                    <div class="p-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                            @foreach($users ?? [] as $user)

                                <div class="border border-gray-200 rounded-2xl p-5 hover:shadow-xl transition">

                                    <div class="flex items-center justify-between mb-4">

                                        <div>
                                            <h4 class="font-bold text-gray-800">
                                                {{ $user->name }}
                                            </h4>

                                            <p class="text-sm text-gray-500">
                                                {{ $user->email }}
                                            </p>
                                        </div>

                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $user->role === 'admin'
                                                ? 'bg-red-100 text-red-700'
                                                : 'bg-blue-100 text-blue-700' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>

                                    </div>

                                    <div class="flex justify-between text-sm text-gray-600">
                                        <span>Books: {{ $user->books->count() }}</span>

                                        <span>
                                            {{ $user->created_at->format('M d, Y') }}
                                        </span>
                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>
                </div>

            @endif

            {{-- BOOKS SECTION --}}
            <div class="bg-white rounded-2xl shadow-lg">

                <div class="border-b px-6 py-4">

                    <div class="flex items-center justify-between">

                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">
                                Books
                            </h3>

                            <p class="text-sm text-gray-500">
                                @if(auth()->user()->role === 'admin')
                                    All uploaded books in the system
                                @else
                                    Your personal uploaded books
                                @endif
                            </p>
                        </div>

                        <a href="{{ route('books.create') }}"
                           class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl shadow-md transition">
                            + Add Book
                        </a>

                    </div>
                </div>

                <div class="p-6">

                    @if(($books ?? [])->isEmpty())

                        <div class="text-center py-16">

                            <div class="text-7xl mb-4">
                                📚
                            </div>

                            <h3 class="text-2xl font-bold text-gray-700">
                                No Books Found
                            </h3>

                        </div>

                    @else

                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                            @foreach($books ?? [] as $book)

                                <div class="border border-gray-200 rounded-2xl p-5 hover:shadow-xl transition">

                                    <div class="flex justify-between items-start mb-4">

                                        <div>
                                            <h4 class="text-xl font-bold text-gray-800">
                                                {{ $book->title }}
                                            </h4>

                                            <p class="text-sm text-gray-500">
                                                by {{ $book->author }}
                                            </p>
                                        </div>

                                    </div>

                                    <p class="text-sm text-gray-600 mb-4">
                                        {{ $book->description }}
                                    </p>

                                    @if(auth()->user()->role === 'admin' && $book->user_id !== auth()->id())

                                        <p class="text-xs text-gray-500 mb-4">
                                            Owner: {{ $book->user->name }}
                                        </p>

                                    @endif

                                    <div class="flex items-center gap-4 text-sm">

                                        <a href="{{ route('books.show', $book) }}"
                                           class="text-indigo-600 hover:text-indigo-800 font-semibold">
                                            View
                                        </a>

                                        @can('update', $book)

                                            <a href="{{ route('books.edit', $book) }}"
                                               class="text-blue-600 hover:text-blue-800 font-semibold">
                                                Edit
                                            </a>

                                        @endcan

                                        @can('delete', $book)

                                            <form action="{{ route('books.destroy', $book) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Delete this book?');">

                                                @csrf
                                                @method('DELETE')

                                                <button class="text-red-600 hover:text-red-800 font-semibold">
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

        </div>
    </div>
</x-app-layout>