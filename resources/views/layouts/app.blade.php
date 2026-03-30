<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'DevHub.Tools – Herramientas para Desarrolladores con IA')</title>
        <meta name="description" content="@yield('meta_description', 'DevHub.Tools: Conversor de lenguajes de programación, traductor de idiomas, convertidor de bases de datos SQL/MongoDB, diccionario de código. Potenciado por IA.')">
        <meta name="keywords" content="@yield('meta_keywords', 'conversor sql eloquent, traductor de idiomas, convertir php javascript, bases de datos mongodb mysql, diccionario programacion, code translator, sql to mongodb, php to js, traductor programacion')">
        <meta name="robots" content="@yield('meta_robots', 'index, follow')">
        <link rel="canonical" href="{{ request()->url() }}">

        <!-- Open Graph para redes sociales -->
        <meta property="og:title" content="@yield('title', 'DevHub.Tools – Herramientas para Desarrolladores')">
        <meta property="og:description" content="@yield('meta_description', 'Convierte SQL a Eloquent, traduce idiomas, convierte bases de datos y más. Potenciado por Google Gemini.')">
        <meta property="og:url" content="{{ request()->url() }}">
        <meta property="og:type" content="website">
        <meta name="twitter:card" content="summary_large_image">

        <!-- Datos estructurados para Google -->
        <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "WebApplication",
            "name": "DevHub.Tools",
            "description": "Plataforma de herramientas para desarrolladores: conversor de lenguajes de programación, traductor de idiomas, convertidor de bases de datos y diccionario de código.",
            "url": "{{ config('app.url') }}",
            "applicationCategory": "DeveloperApplication"
        }
        </script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Top Ad Banner -->
            <div id="top-ad-banner" class="w-full bg-gray-200 dark:bg-gray-800 text-center py-3 text-xs text-gray-400 border-b border-gray-300 dark:border-gray-700">
                [Espacio para anuncio – 728x90]
            </div>

            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <div class="flex-grow flex max-w-7xl w-full mx-auto py-8 px-4 sm:px-6 lg:px-8 gap-6">
                <main class="flex-1 min-w-0">
                    {{ $slot }}
                </main>

                <aside id="sidebar-ad" class="hidden xl:flex flex-col w-64 flex-shrink-0 gap-4">
                    <div class="bg-gray-200 dark:bg-gray-800 rounded-xl p-4 text-center text-xs text-gray-400 border border-gray-300 dark:border-gray-700 min-h-[300px] flex items-center justify-center">
                        [Anuncio – 300x300]
                    </div>
                </aside>
            </div>

            <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        &copy; {{ date('Y') }} <strong>DevHub.Tools</strong> – Potenciado por Google Gemini AI
                    </p>
                    <nav class="flex gap-4 text-xs text-gray-400">
                        <a href="{{ route('home') }}" class="hover:text-purple-500 transition-colors">Inicio</a>
                        <a href="{{ route('tool.universal') }}" class="hover:text-purple-500 transition-colors">Code Translator</a>
                        <a href="{{ route('tool.language') }}" class="hover:text-purple-500 transition-colors">Traductor de Idiomas</a>
                        <a href="{{ route('tool.database') }}" class="hover:text-purple-500 transition-colors">DB Converter</a>
                        <a href="{{ route('tool.dictionary') }}" class="hover:text-purple-500 transition-colors">Diccionario</a>
                    </nav>
                </div>
            </footer>
        </div>

        @stack('scripts')
    </body>
</html>
