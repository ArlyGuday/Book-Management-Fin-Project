<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-800">
             My Profile
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-100 py-10">

        <div class="max-w-4xl mx-auto space-y-6">

            {{-- PROFILE CARD --}}
            <div class="bg-white rounded-3xl shadow-lg p-8 flex items-center gap-6">

                {{-- Avatar --}}
                <div class="w-24 h-24 rounded-full bg-blue-600 text-white flex items-center justify-center text-3xl font-bold uppercase shadow">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>

                {{-- Info --}}
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">
                        {{ auth()->user()->name }}
                    </h3>

                    <p class="text-gray-500">
                        {{ auth()->user()->email }}
                    </p>

                    <span class="inline-block mt-2 text-xs px-3 py-1 rounded-full 
                        {{ auth()->user()->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-green-100 text-green-700' }}">
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                </div>

            </div>

            {{-- UPDATE PROFILE FORM --}}
            <div class="bg-white rounded-3xl shadow-lg p-8">

                <h3 class="text-xl font-bold text-gray-800 mb-6">
                    ✏️ Update Profile
                </h3>

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
                    @csrf
                    @method('PATCH')

                    {{-- Name --}}
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Name</label>
                        <input type="text" name="name"
                               value="{{ old('name', auth()->user()->name) }}"
                               class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-blue-200">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" name="email"
                               value="{{ old('email', auth()->user()->email) }}"
                               class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-blue-200">
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-end gap-3 pt-4">

                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl font-semibold shadow">
                            Save Changes
                        </button>

                    </div>

                </form>

            </div>

            {{-- SECURITY SECTION --}}
            <div class="bg-white rounded-3xl shadow-lg p-8">

                <h3 class="text-xl font-bold text-gray-800 mb-6">
                    🔐 Change Password
                </h3>

                <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Current Password --}}
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Current Password</label>
                        <input type="password" name="current_password"
                               class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-yellow-200">
                    </div>

                    {{-- New Password --}}
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">New Password</label>
                        <input type="password" name="password"
                               class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-yellow-200">
                    </div>

                    {{-- Confirm --}}
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                               class="w-full border-gray-300 rounded-xl shadow-sm focus:ring focus:ring-yellow-200">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-xl font-semibold shadow">
                            Update Password
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>
</x-app-layout>