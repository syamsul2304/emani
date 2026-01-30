<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: false, sidebarCollapse: false }" x-init="
    sidebarCollapse = JSON.parse(localStorage.getItem('sidebarCollapse')) || false;
" x-cloak class="h-full transition-colors duration-500 ease-in-out">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">


    {{-- AlpineJS & Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="font-sans antialiased bg-gray-200 text-gray-800 dark:bg-gray-900 dark:text-gray-100 transition-colors duration-500">
    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside
            class="z-40 fixed inset-y-0 left-0 bg-gray-300 dark:bg-gray-800 shadow-md transition-all duration-500 ease-in-out overflow-y-auto"
            :class="sidebarCollapse ? 'w-20' : 'w-64'"
            @click.outside="sidebarOpen = false"
            x-show="sidebarOpen || window.innerWidth >= 768"
            x-transition>
            <div class="h-full p-4 flex flex-col">
                <div class="mb-6 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white transition-colors duration-500" x-show="!sidebarCollapse">📚 Website Magang</h2>
                    <button @click="sidebarCollapse = !sidebarCollapse; localStorage.setItem('sidebarCollapse', sidebarCollapse)" class="text-gray-600 hover:text-black dark:text-gray-300 dark:hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path x-show="!sidebarCollapse" stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            <path x-show="sidebarCollapse" stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 transition-colors duration-500">Rapat & Arsip</p>

                <nav class="space-y-2 flex-1">
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-300"
                       :class="{ 'justify-center': sidebarCollapse }"
                       title="Dashboard">
                        <span class="mr-3">🏠</span>
                        <span x-show="!sidebarCollapse">Dashboard</span>
                    </a>
                    <a href="{{ route('notulen.index') }}"
                       class="flex items-center px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-300"
                       :class="{ 'justify-center': sidebarCollapse }"
                       title="Notulen Rapat">
                        <span class="mr-3">📑</span>
                        <span x-show="!sidebarCollapse">Notulen</span>
                    </a>
                    <a href="{{ route('arsip.index') }}"
                       class="flex items-center px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-300"
                       :class="{ 'justify-center': sidebarCollapse }"
                       title="e-Arsip">
                        <span class="mr-3">🗂️</span>
                        <span x-show="!sidebarCollapse">e-Arsip</span>
                    </a>
                </nav>
            </div>
        </aside>

        {{-- Main Content --}}
        <div :class="sidebarCollapse ? 'md:ml-20' : 'md:ml-64'" class="flex flex-col flex-1 transition-all duration-500 ease-in-out">
            {{-- Navbar --}}
            <div class="fixed top-0 right-0 left-0 z-50 transition-all duration-500 ease-in-out" :class="sidebarCollapse ? 'md:ml-20' : 'md:ml-64'">
                @include('layouts.navigation')
            </div>

            {{-- Tombol Toggle Sidebar (mobile) --}}
            <div class="md:hidden fixed top-4 left-4 z-50">
                <button @click="sidebarOpen = !sidebarOpen" class="bg-gray-300 dark:bg-gray-700 text-black dark:text-white p-2 rounded shadow hover:bg-gray-400 dark:hover:bg-gray-600 transition-colors duration-300">
                    ☰
                </button>
            </div>

            {{-- Dark Mode Toggle --}}
            <div class="fixed bottom-5 right-5 z-50">
                <button onclick="toggleDarkMode()" class="bg-gray-300 dark:bg-gray-700 text-black dark:text-white px-3 py-2 rounded shadow hover:bg-gray-400 dark:hover:bg-gray-600 transition-colors duration-300">
                    🌗
                </button>
            </div>

            {{-- Flash Message --}}
            @if (session('success'))
                <div class="mx-4 mt-20 p-4 bg-green-100 border border-green-300 text-green-800 dark:bg-green-900 dark:text-green-100 dark:border-green-700 rounded shadow transition-colors duration-500">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Header --}}
            @hasSection('header')
                <header class="bg-gray-300 dark:bg-gray-800 shadow mt-16 transition-colors duration-500">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
            @endif

            {{-- Page Content --}}
            <main class="flex-grow pt-4 mt-4 px-4 sm:px-6 lg:px-8 overflow-y-auto transition-colors duration-500">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Dark Mode Script --}}
    <script>
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        }

        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

    @stack('scripts')
</body>
</html>
