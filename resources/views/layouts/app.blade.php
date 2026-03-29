<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'DevHub-Tools'))</title>
        @yield('meta_tags')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Top Ad Banner -->
            <div id="top-ad-banner" class="w-full bg-gray-200 dark:bg-gray-800 text-center py-4 text-sm text-gray-500 border-b border-gray-300 dark:border-gray-700">
                [Top Ad Space - 728x90]
            </div>

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <div class="flex-grow flex w-full max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 gap-6">
                <!-- Main Page Content -->
                <main class="flex-1">
                    {{ $slot }}
                </main>

                <!-- Sidebar Ad -->
                <aside id="sidebar-ad" class="hidden lg:block w-72 bg-gray-200 dark:bg-gray-800 rounded-lg p-4 text-center text-sm text-gray-500 border border-gray-300 dark:border-gray-700 flex flex-col items-center justify-center min-h-[500px]">
                    [Sidebar Ad Space - 300x500]
                </aside>
            </div>
            
            <footer class="bg-white dark:bg-gray-800 shadow mt-auto py-6 text-center text-gray-500 dark:text-gray-400 text-sm">
                &copy; {{ date('Y') }} DevHub-Tools. All rights reserved.
            </footer>
        </div>
        
        @stack('scripts')
    </body>
</html>
