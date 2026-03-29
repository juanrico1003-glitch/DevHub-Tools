<x-app-layout>
    @section('title', 'DevHub Tools - Developer Essentials')
    @section('meta_tags')
        <meta name="description" content="A comprehensive Micro-SaaS collection of developer tools like SQL to Eloquent converters, JSON visualizers, and more.">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Developer Tools Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- SQL to Eloquent Card -->
        <a href="{{ route('tool.sql-to-eloquent') }}" class="group block overflow-hidden rounded-xl bg-white dark:bg-gray-800 shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg ring-1 ring-gray-200 dark:ring-gray-700">
            <div class="h-32 bg-gradient-to-r from-blue-500 to-indigo-600 p-6 flex items-end">
                <svg class="h-10 w-10 text-white/80 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-500 transition-colors">SQL to Eloquent</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Convert your raw MySQL queries into Laravel Eloquent ORM syntax instantly. Great for beginners learning Laravel.</p>
            </div>
        </a>

        <!-- JSON Formatter Card -->
        <a href="{{ route('tool.json-formatter') }}" class="group block overflow-hidden rounded-xl bg-white dark:bg-gray-800 shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg ring-1 ring-gray-200 dark:ring-gray-700">
            <div class="h-32 bg-gradient-to-r from-emerald-500 to-teal-600 p-6 flex items-end">
                <svg class="h-10 w-10 text-white/80 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-emerald-500 transition-colors">JSON Formatter</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Validate, format, and interact with your JSON data in a beautiful interface with full syntax highlighting.</p>
            </div>
        </a>

        <!-- Route Generator Card -->
        <a href="{{ route('tool.route-generator') }}" class="group block overflow-hidden rounded-xl bg-white dark:bg-gray-800 shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg ring-1 ring-gray-200 dark:ring-gray-700">
            <div class="h-32 bg-gradient-to-r from-orange-500 to-red-600 p-6 flex items-end">
                <svg class="h-10 w-10 text-white/80 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-orange-500 transition-colors">Route Generator</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Visually build and scaffold out your `web.php` or `api.php` routes using a straightforward GUI.</p>
            </div>
        </a>
    </div>
</x-app-layout>
