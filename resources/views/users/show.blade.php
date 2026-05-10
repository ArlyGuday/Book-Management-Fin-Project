<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">User Information</h3>
                    <p class="mb-2"><strong>Name:</strong> {{ $user->name }}</p>
                    <p class="mb-2"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="mb-4"><strong>Role:</strong> <span class="px-3 py-1 bg-{{ $user->role === 'admin' ? 'red' : 'blue' }}-100 text-{{ $user->role === 'admin' ? 'red' : 'blue' }}-800 rounded-full text-sm font-semibold">{{ ucfirst($user->role) }}</span></p>
                    
                    <div class="flex gap-4">
                        @can('update', $user)
                            <a href="{{ route('users.edit', $user) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Edit</a>
                        @endcan
                        <a href="{{ route('users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Back</a>
                    </div>
                </div>
            </div>

            <!-- User's Books -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Books ({{ $user->books->count() }})</h3>

                    @if ($user->books->isEmpty())
                        <p class="text-gray-500">No books yet.</p>
                    @else
                        <div class="space-y-4">
                            @foreach ($user->books as $book)
                                <div class="border p-4 rounded-lg">
                                    <h4 class="font-bold">{{ $book->title }}</h4>
                                    <p class="text-sm text-gray-600">by {{ $book->author }}</p>
                                    <p class="text-sm text-gray-700 mt-1">{{ $book->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
