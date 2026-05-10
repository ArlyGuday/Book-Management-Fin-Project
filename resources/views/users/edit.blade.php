<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-800">
            ✏️ Edit User
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-100 py-10">

        <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-lg p-8">

            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Name</label>
                    <input type="text" name="name"
                        value="{{ $user->name }}"
                        class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-yellow-200">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email"
                        value="{{ $user->email }}"
                        class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-yellow-200">
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        Password <span class="text-sm text-gray-400">(leave blank if not changing)</span>
                    </label>
                    <input type="password" name="password"
                        class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-yellow-200"
                        placeholder="New password">
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Role</label>
                    <select name="role"
                        class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-yellow-200">

                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>
                            User
                        </option>

                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>

                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3">

                    <a href="{{ route('users.index') }}"
                        class="px-5 py-2 rounded-xl bg-red-300 hover:bg-red-400 text-black-800 font-semibold">
                        Cancel
                    </a>

                    <button type="submit" onclick="return confirm('Are you sure you want to update this user?')"
                        class="px-5 py-2 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-black-800 font-semibold">
                        Update User
                    </button>

                </div>

            </form>

        </div>

    </div>
</x-app-layout>