<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School ERP</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <h1 class="text-2xl font-bold text-blue-600">
                School ERP
            </h1>

            <div class="flex items-center gap-3">

                @auth
                    <a href="{{ route('dashboard') }}"
                       class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-medium">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="px-5 py-2 text-gray-700 hover:text-blue-600 font-medium">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-medium">
                        Register
                    </a>
                @endauth

            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-20">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

            <!-- Left -->
            <div>

                <span class="inline-block px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold mb-4">
                    Smart School Management
                </span>

                <h2 class="text-5xl font-bold leading-tight text-gray-900">
                    Manage Your School with Modern ERP Software
                </h2>

                <p class="mt-6 text-lg text-gray-600 leading-8">
                    Admissions, fees, students, teachers, reports and analytics —
                    everything in one powerful dashboard.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">

                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                           class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold">
                            Get Started
                        </a>

                        <a href="{{ route('login') }}"
                           class="px-6 py-3 border border-gray-300 hover:bg-white rounded-xl font-semibold">
                            Login
                        </a>
                    @endauth

                </div>

            </div>

            <!-- Right -->
            <div>

                <div class="bg-white rounded-3xl shadow-2xl p-8">

                    <div class="grid grid-cols-2 gap-5">

                        <div class="bg-blue-50 p-5 rounded-2xl">
                            <p class="text-sm text-gray-500">Students</p>
                            <h3 class="text-3xl font-bold text-blue-600 mt-2">1250+</h3>
                        </div>

                        <div class="bg-green-50 p-5 rounded-2xl">
                            <p class="text-sm text-gray-500">Teachers</p>
                            <h3 class="text-3xl font-bold text-green-600 mt-2">85+</h3>
                        </div>

                        <div class="bg-yellow-50 p-5 rounded-2xl">
                            <p class="text-sm text-gray-500">Fee Collection</p>
                            <h3 class="text-3xl font-bold text-yellow-600 mt-2">₹12L+</h3>
                        </div>

                        <div class="bg-red-50 p-5 rounded-2xl">
                            <p class="text-sm text-gray-500">Reports</p>
                            <h3 class="text-3xl font-bold text-red-600 mt-2">24/7</h3>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Features -->
    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-900">
                    Powerful Features
                </h3>
                <p class="text-gray-500 mt-3">
                    Everything your school needs to run smoothly.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-gray-50 p-6 rounded-2xl shadow-sm">
                    <h4 class="text-xl font-semibold mb-2">Student Management</h4>
                    <p class="text-gray-600">Admissions, classes, profiles and records.</p>
                </div>

                <div class="bg-gray-50 p-6 rounded-2xl shadow-sm">
                    <h4 class="text-xl font-semibold mb-2">Fee Management</h4>
                    <p class="text-gray-600">Receipts, dues, monthly fees and reports.</p>
                </div>

                <div class="bg-gray-50 p-6 rounded-2xl shadow-sm">
                    <h4 class="text-xl font-semibold mb-2">Analytics Dashboard</h4>
                    <p class="text-gray-600">Real-time insights for school growth.</p>
                </div>

            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-6">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between gap-4">

            <p>© {{ date('Y') }} School ERP. All rights reserved.</p>

            <p>Built with Laravel + Tailwind CSS</p>

        </div>
    </footer>

</body>
</html>