<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-800">
            ➕ Create New User
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-100 py-10">

        <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-lg p-8">

            <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-blue-200 @error('name') border-red-500 @enderror"
                        placeholder="Enter full name">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-blue-200 @error('email') border-red-500 @enderror"
                        placeholder="Enter email address">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="password" name="password"
                        class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-blue-200 @error('password') border-red-500 @enderror"
                        placeholder="Enter password">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Role</label>
                    <select name="role"
                        class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-blue-200 @error('role') border-red-500 @enderror">
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3">

                    <a href="{{ route('users.index') }}"
                        class="px-5 py-2 rounded-xl bg-red-300 hover:bg-red-400 text-black-800 font-semibold">
                        Cancel
                    </a>

                    <button type="submit" onclick="return confirm('Are you sure you want to create this new user?')"
                        class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-black-800 font-semibold">
                        Save User
                    </button>

                </div>

            </form>

        </div>

    </div>
</x-app-layout>