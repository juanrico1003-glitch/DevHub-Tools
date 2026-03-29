<x-app-layout>
    @section('title', 'DevHub Tools - Developer Essentials')
    @section('meta_tags')
        <meta name="description" content="A comprehensive AI-Powered Micro-SaaS for web developers.">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Developer Tools Dashboard') }}
        </h2>
    </x-slot>

    <!-- Welcome Section -->
    <div class="mb-8 p-8 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-2xl shadow-lg text-white">
        <h1 class="text-3xl font-extrabold mb-2">Welcome to your AI Developer Hub 🚀</h1>
        <p class="text-lg opacity-90">We've consolidated all legacy tools into a powerful AI engine. What would you like to build today?</p>
    </div>

    <!-- The Universal Tool -->
    <div class="flex justify-center">
        <!-- Universal AI Converter Card -->
        <a href="{{ route('tool.universal') }}" class="w-full max-w-4xl group block overflow-hidden rounded-2xl bg-white dark:bg-gray-800 shadow-xl transition-all hover:-translate-y-2 hover:shadow-2xl ring-2 ring-purple-500 hover:ring-purple-600 relative">
            <div class="absolute top-0 right-0 p-4">
                <span class="inline-flex items-center rounded-full bg-purple-50 dark:bg-purple-900/40 px-3 py-1 text-xs font-bold text-purple-700 dark:text-purple-300 ring-1 ring-inset ring-purple-500/30 shadow-sm backdrop-blur-md">✨ Google Gemini Powered</span>
            </div>
            <div class="h-48 bg-gradient-to-br from-purple-800 via-fuchsia-700 to-indigo-800 p-8 flex items-end relative overflow-hidden">
                <!-- Decorative circles -->
                <div class="absolute -right-10 -top-10 bg-white opacity-10 w-40 h-40 rounded-full blur-2xl"></div>
                <div class="absolute left-10 bottom-0 bg-pink-400 opacity-20 w-32 h-32 rounded-full blur-xl mix-blend-overlay"></div>
                
                <svg class="h-16 w-16 text-white/90 shadow-2xl transition-transform duration-500 group-hover:scale-125 group-hover:rotate-6 z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
            </div>
            <div class="p-8">
                <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-purple-500 transition-colors">Universal Translator</h3>
                <p class="text-base text-gray-600 dark:text-gray-400 leading-relaxed">
                    Instantly translate and convert code algorithms, frameworks, and queries flawlessly. Turn SQL to Eloquent, CSS to Tailwind, PHP to Javascript, or even COBOL to Python. The ultimate tool for modern devs.
                </p>
                
                <div class="mt-6 flex flex-wrap gap-2">
                    <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-xs rounded text-gray-600 dark:text-gray-300 font-mono">SQL → Eloquent</span>
                    <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-xs rounded text-gray-600 dark:text-gray-300 font-mono">PHP → JS</span>
                    <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-xs rounded text-gray-600 dark:text-gray-300 font-mono">Tailwind ↔ CSS</span>
                    <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-xs rounded text-gray-600 dark:text-gray-300 font-mono">Java/C++/C#</span>
                </div>
            </div>
        </a>
    </div>

</x-app-layout>
