<x-guest-layout>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-100 px-4">

    <div class="w-full max-w-5xl grid md:grid-cols-2 bg-white rounded-3xl shadow-2xl overflow-hidden">

        <!-- Left Side -->
        <div class="hidden md:flex flex-col justify-center bg-gradient-to-br from-blue-600 to-indigo-700 text-white p-10">

            <h1 class="text-4xl font-bold leading-tight">
                School ERP System
            </h1>

            <p class="mt-4 text-blue-100 text-lg">
                Create your account and manage students, fees, teachers, reports & more.
            </p>

            <div class="mt-10 space-y-4 text-sm">

                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">✓</span>
                    Student Management
                </div>

                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">✓</span>
                    Fee Collection
                </div>

                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">✓</span>
                    Reports & Analytics
                </div>

                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">✓</span>
                    Admin Dashboard
                </div>

            </div>

        </div>

        <!-- Right Side -->
        <div class="p-8 md:p-10">

            <div class="mb-8 text-center">

                <h2 class="text-3xl font-bold text-gray-800">
                    Create Account
                </h2>

                <p class="text-gray-500 mt-2">
                    Register to access your School ERP dashboard
                </p>

            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Full Name')" class="mb-1" />

                    <x-text-input id="name"
                        class="w-full rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Enter full name" />

                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email Address')" class="mb-1" />

                    <x-text-input id="email"
                        class="w-full rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autocomplete="username"
                        placeholder="Enter email address" />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="mb-1" />

                    <x-text-input id="password"
                        class="w-full rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="Enter password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="mb-1" />

                    <x-text-input id="password_confirmation"
                        class="w-full rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Confirm password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Footer -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2">

                    <a href="{{ route('login') }}"
                       class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                        Already registered?
                    </a>

                    <x-primary-button class="justify-center px-8 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white shadow-lg">
                        {{ __('Register') }}
                    </x-primary-button>

                </div>

            </form>

        </div>

    </div>

</div>

</x-guest-layout>