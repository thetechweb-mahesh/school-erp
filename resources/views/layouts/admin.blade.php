<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'School ERP'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        @include('layouts.inc.admin_sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-64">

            <!-- Header -->
            @include('layouts.inc.admin_header')

            <!-- Page Heading -->
            @hasSection('header')
                <div class="bg-white border-b border-gray-200 px-6 py-4 shadow-sm">
                    <h1 class="text-2xl font-semibold text-gray-800">
                        @yield('header')
                    </h1>
                </div>
            @endif

            <!-- Main Content -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>

            <!-- Footer -->
            @include('layouts.inc.admin_footer')

        </div>

    </div>

</body>

</html>