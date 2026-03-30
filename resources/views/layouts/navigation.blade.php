<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo + Nav Links -->
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-xl font-extrabold tracking-tight">
                    <span class="text-purple-500">Dev</span><span class="text-gray-800 dark:text-white">Hub</span><span class="text-purple-500">.</span><span class="text-gray-800 dark:text-white">Tools</span>
                </a>
                <!-- Desktop Nav -->
                <div class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('tool.universal') }}"
                       class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('tool.universal') ? 'bg-purple-50 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }} transition-colors">
                       💻 Code
                    </a>
                    <a href="{{ route('tool.language') }}"
                       class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('tool.language') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }} transition-colors">
                       🌍 Idiomas
                    </a>
                    <a href="{{ route('tool.database') }}"
                       class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('tool.database') ? 'bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }} transition-colors">
                       🗄️ Bases de Datos
                    </a>
                    <a href="{{ route('tool.dictionary') }}"
                       class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('tool.dictionary') ? 'bg-orange-50 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }} transition-colors">
                       📖 Diccionario
                    </a>
                </div>
            </div>

            <!-- Right side -->
            <div class="hidden sm:flex sm:items-center gap-3">
                @auth
                    @if(Auth::user()->email === 'juanrico1003@gmail.com')
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold {{ request()->routeIs('dashboard') ? 'bg-purple-600 text-white' : 'text-purple-600 dark:text-purple-400 border border-purple-300 dark:border-purple-700 hover:bg-purple-50 dark:hover:bg-purple-900/30' }} transition-colors">
                           📊 Dashboard
                        </a>
                    @endif
                    <a href="{{ route('history') }}" class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors">Historial</a>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-white text-xs font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Perfil</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Cerrar Sesión</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors">Entrar</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold rounded-lg transition-colors">Registro</a>
                @endguest
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-white dark:bg-gray-800 border-t dark:border-gray-700">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('tool.universal') }}" class="block px-3 py-2 rounded text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">💻 Code Translator</a>
            <a href="{{ route('tool.language') }}" class="block px-3 py-2 rounded text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">🌍 Traductor de Idiomas</a>
            <a href="{{ route('tool.database') }}" class="block px-3 py-2 rounded text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">🗄️ Bases de Datos</a>
            <a href="{{ route('tool.dictionary') }}" class="block px-3 py-2 rounded text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">📖 Diccionario Dev</a>
            @auth
                @if(Auth::user()->email === 'juanrico1003@gmail.com')
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded text-sm font-bold text-purple-600">📊 Dashboard Admin</a>
                @endif
                <a href="{{ route('history') }}" class="block px-3 py-2 rounded text-sm text-gray-700 dark:text-gray-300">Historial</a>
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button class="w-full text-left px-3 py-2 rounded text-sm text-gray-700 dark:text-gray-300">Cerrar Sesión</button>
                </form>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="block px-3 py-2 rounded text-sm text-gray-700 dark:text-gray-300">Entrar</a>
                <a href="{{ route('register') }}" class="block px-3 py-2 rounded text-sm font-semibold text-purple-600">Registro</a>
            @endguest
        </div>
    </div>
</nav>
