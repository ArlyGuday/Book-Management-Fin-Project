<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">

            <!-- LEFT SIDE -->
            <div>
                <h2 class="text-3xl font-bold text-gray-800">
                    👥 Users Management
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Manage registered users in the system
                </p>
            </div>

            <!-- RIGHT SIDE BUTTON -->
            <a href="{{ route('users.create') }}"
               class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-3 rounded-xl font-semibold shadow-lg transition">

                + Add User
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

            {{-- EMPTY STATE --}}
            @if($users->isEmpty())

                <div class="bg-white rounded-3xl shadow-lg p-16 text-center">

                    <h3 class="text-3xl font-bold text-gray-700 mb-2">
                        No Users Found
                    </h3>

                    <p class="text-gray-500">
                        There are no registered users yet.
                    </p>

                </div>

            @else

                {{-- USERS GRID --}}
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    @foreach ($users as $user)

                        <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition duration-300 p-6 border border-gray-100">

                            {{-- USER HEADER --}}
                            <div class="flex items-center gap-4 mb-4">

                                <div class="w-14 h-14 rounded-full bg-blue-500 text-white flex items-center justify-center text-xl font-bold uppercase">
                                    {{ substr($user->name, 0, 1) }}
                                </div>

                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">
                                        {{ $user->name }}
                                    </h3>

                                    <p class="text-gray-500 text-sm">
                                        {{ $user->email }}
                                    </p>
                                </div>

                            </div>

                            {{-- ROLE --}}
                            <div class="mb-5">
                                <span class="text-xs px-3 py-1 rounded-full 
                                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-green-100 text-green-700' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>

                            {{-- INFO --}}
                            <div class="text-sm text-gray-600 space-y-1 mb-5">
                                <p>
                                    <span class="font-semibold">Joined:</span>
                                    {{ $user->created_at->format('M d, Y') }}
                                </p>

                                <p>
                                    <span class="font-semibold">Books:</span>
                                    {{ $user->books ? $user->books->count() : 0 }}
                                </p>
                            </div>

                            {{-- ACTIONS --}}
                            <div class="flex gap-3 flex-wrap">

                                <a href="{{ route('users.show', $user) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow transition">
                                    View
                                </a>

                                @can('update', $user)
                                    <a href="{{ route('users.edit', $user) }}"
                                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow transition">
                                        Edit
                                    </a>
                                @endcan

                                @can('delete', $user)
                                    <form action="{{ route('users.destroy', $user) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this user?');">

                                        @csrf
                                        @method('DELETE')

                                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow transition">
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