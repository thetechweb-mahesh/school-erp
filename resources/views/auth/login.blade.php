<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 px-4">

        <div class="w-full max-w-5xl grid md:grid-cols-2 bg-white rounded-3xl shadow-2xl overflow-hidden">

            <!-- Left Side -->
            <div class="hidden md:flex flex-col justify-center p-10 bg-gradient-to-br from-blue-700 to-indigo-800 text-white">

                <h1 class="text-4xl font-bold leading-tight mb-4">
                    School ERP System
                </h1>

                <p class="text-blue-100 text-lg mb-8">
                    Manage students, fees, attendance, reports and complete school administration from one dashboard.
                </p>

                <div class="space-y-4 text-sm">

                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 bg-white rounded-full"></span>
                        Student Management
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 bg-white rounded-full"></span>
                        Fee Collection & Receipts
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 bg-white rounded-full"></span>
                        Reports & Analytics
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 bg-white rounded-full"></span>
                        Teacher & Staff Access
                    </div>

                </div>

            </div>

            <!-- Right Side -->
            <div class="p-8 md:p-12">

                <div class="text-center mb-8">

                    <h2 class="text-3xl font-bold text-gray-800">
                        Welcome Back 👋
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Login to access your admin panel
                    </p>

                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email Address')" class="mb-1" />

                        <x-text-input
                            id="email"
                            class="block w-full rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Enter your email"
                        />

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="mb-1" />

                        <x-text-input
                            id="password"
                            class="block w-full rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"
                        />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember -->
                    <div class="flex items-center justify-between">

                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me"
                                   type="checkbox"
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                                   name="remember">

                            <span class="ms-2 text-sm text-gray-600">
                                Remember me
                            </span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                                Forgot Password?
                            </a>
                        @endif

                    </div>

                    <!-- Button -->
                    <div class="pt-2">

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl shadow-lg transition duration-200">
                            Log In
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-guest-layout>