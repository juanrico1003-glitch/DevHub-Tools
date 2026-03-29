<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-xl font-extrabold text-indigo-600 dark:text-indigo-400 tracking-tight">
                    <span class="text-purple-500">Dev</span>Hub<span class="text-purple-500">.</span>Tools
                </a>
            </div>

            <!-- Desktop Nav -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">
                {{-- Admin-only Dashboard link --}}
                @auth
                    @if(Auth::user()->email === 'juanrico1003@gmail.com')
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-semibold
                                  {{ request()->routeIs('dashboard') ? 'bg-purple-600 text-white' : 'text-gray-500 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400' }}
                                  transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            Admin Dashboard
                        </a>
                    @endif

                    <a href="{{ route('history') }}"
                       class="text-sm font-medium {{ request()->routeIs('history') ? 'text-purple-600 dark:text-purple-400' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300' }} transition-colors">
                        Mi Historial
                    </a>

                    <!-- User Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-white text-xs font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Perfil') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Cerrar Sesión') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-colors">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors">Registrarse</a>
                @endguest
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 px-4">
            @auth
                @if(Auth::user()->email === 'juanrico1003@gmail.com')
                    <a href="{{ route('dashboard') }}" class="block py-2 text-sm font-semibold text-purple-600 dark:text-purple-400">Admin Dashboard</a>
                @endif
                <a href="{{ route('history') }}" class="block py-2 text-sm text-gray-600 dark:text-gray-300">Mi Historial</a>
                <a href="{{ route('profile.edit') }}" class="block py-2 text-sm text-gray-600 dark:text-gray-300">Perfil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block py-2 text-sm text-gray-600 dark:text-gray-300">Cerrar Sesión</button>
                </form>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="block py-2 text-sm text-gray-600 dark:text-gray-300">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="block py-2 text-sm font-semibold text-purple-600 dark:text-purple-400">Registrarse</a>
            @endguest
        </div>
    </div>
</nav>
