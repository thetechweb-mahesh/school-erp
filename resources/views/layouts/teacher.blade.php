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
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- ONLY VITE (REMOVE CDN IN PRODUCTION) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 overflow-hidden">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <div class="w-64 fixed inset-y-0 left-0 bg-white shadow-md z-30">
            @include('layouts.inc.teacher_sidebar')
        </div>

        <!-- Main Wrapper -->
        <div class="flex flex-col flex-1 ml-64">

            <!-- Header -->
            <header class="bg-white shadow-sm z-20">
                @include('layouts.inc.teacher_header')
            </header>

            <!-- Optional Page Header -->
            @hasSection('header')
                <div class="bg-white border-b px-6 py-4">
                    <h1 class="text-xl font-semibold text-gray-800">
                        @yield('header')
                    </h1>
                </div>
            @endif

            <!-- Scrollable Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>

        </div>

    </div>

</body>

</html>