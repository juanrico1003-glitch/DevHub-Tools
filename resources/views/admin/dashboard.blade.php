<x-app-layout>
    @section('title', 'Admin Dashboard - DevHub Tools')
    @section('meta_tags')
        <meta name="robots" content="noindex, nofollow">
    @endsection

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-100 leading-tight">
                🛡️ Panel de Administrador
            </h2>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ now()->format('D, d M Y – H:i') }}</span>
        </div>
    </x-slot>

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="bg-gradient-to-br from-purple-600 to-indigo-700 rounded-2xl p-5 text-white shadow-lg">
            <p class="text-sm font-semibold opacity-80">Total Conversiones IA</p>
            <p class="text-4xl font-extrabold mt-1">{{ number_format($totalConversions) }}</p>
        </div>
        <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-5 text-white shadow-lg">
            <p class="text-sm font-semibold opacity-80">Usuarios Registrados</p>
            <p class="text-4xl font-extrabold mt-1">{{ number_format($totalUsersRegistered) }}</p>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-amber-600 rounded-2xl p-5 text-white shadow-lg">
            <p class="text-sm font-semibold opacity-80">Conversiones Hoy</p>
            <p class="text-4xl font-extrabold mt-1">{{ number_format($conversionsToday) }}</p>
        </div>
        <div class="bg-gradient-to-br from-pink-500 to-rose-600 rounded-2xl p-5 text-white shadow-lg">
            <p class="text-sm font-semibold opacity-80">Esta Semana</p>
            <p class="text-4xl font-extrabold mt-1">{{ number_format($conversionsThisWeek) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

        {{-- TOP LANGUAGES --}}
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl shadow-sm ring-1 ring-gray-200 dark:ring-gray-700 p-6">
            <h3 class="text-base font-bold text-gray-800 dark:text-gray-200 mb-5">🔥 Conversiones más populares</h3>
            @if($topLanguages->isEmpty())
                <p class="text-sm text-gray-400">Aún no hay datos suficientes.</p>
            @else
                @php $maxLang = $topLanguages->first()->total @endphp
                <ul class="space-y-3">
                    @foreach($topLanguages as $lang)
                        <li>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="font-mono text-gray-700 dark:text-gray-300">{{ $lang->label }}</span>
                                <span class="font-bold text-purple-600 dark:text-purple-400">{{ $lang->total }}</span>
                            </div>
                            <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-purple-500 to-indigo-500 h-2 rounded-full transition-all duration-700"
                                     style="width: {{ ($lang->total / $maxLang) * 100 }}%"></div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- TOP USERS --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm ring-1 ring-gray-200 dark:ring-gray-700 p-6">
            <h3 class="text-base font-bold text-gray-800 dark:text-gray-200 mb-5">🏆 Usuarios más activos</h3>
            @if($topUsers->isEmpty())
                <p class="text-sm text-gray-400">No hay usuarios registrados activos aún.</p>
            @else
                <ul class="space-y-3">
                    @foreach($topUsers as $index => $entry)
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-800 dark:text-gray-200 truncate">{{ $entry->user->name ?? 'Usuario desconocido' }}</p>
                                <p class="text-xs text-gray-400 truncate">{{ $entry->user->email ?? '' }}</p>
                            </div>
                            <span class="text-sm font-bold text-purple-600 dark:text-purple-400 flex-shrink-0">{{ $entry->total }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    {{-- DAILY TRAFFIC --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm ring-1 ring-gray-200 dark:ring-gray-700 p-6 mb-6">
        <h3 class="text-base font-bold text-gray-800 dark:text-gray-200 mb-5">📈 Actividad de los últimos 14 días</h3>
        @if($dailyTraffic->isEmpty())
            <p class="text-sm text-gray-400">Sin actividad en este período.</p>
        @else
            @php $maxTraffic = $dailyTraffic->max('total') ?: 1 @endphp
            <div class="flex items-end gap-1.5 h-28">
                @foreach($dailyTraffic as $day)
                    @php $pct = ($day->total / $maxTraffic) * 100 @endphp
                    <div class="flex-1 flex flex-col items-center gap-1 group relative" title="{{ $day->date }}: {{ $day->total }} conversiones">
                        <div class="w-full bg-gradient-to-t from-purple-600 to-indigo-400 rounded-t-sm transition-all duration-500"
                             style="height: {{ max($pct, 4) }}%"></div>
                        <span class="text-[9px] text-gray-400 rotate-45 origin-left mt-1 hidden group-hover:inline absolute -bottom-5">{{ \Carbon\Carbon::parse($day->date)->format('d/m') }}</span>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-between mt-6 text-xs text-gray-400">
                <span>{{ \Carbon\Carbon::parse($dailyTraffic->first()->date)->format('d M') }}</span>
                <span>Hoy</span>
            </div>
        @endif
    </div>

    {{-- LATEST ACTIVITY --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm ring-1 ring-gray-200 dark:ring-gray-700 p-6">
        <h3 class="text-base font-bold text-gray-800 dark:text-gray-200 mb-5">⚡ Últimas actividades en tiempo real</h3>
        @if($latestActivity->isEmpty())
            <p class="text-sm text-gray-400">No hay actividad registrada.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-700">
                            <th class="pb-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Fecha</th>
                            <th class="pb-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Conversión</th>
                            <th class="pb-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Usuario</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                        @foreach($latestActivity as $activity)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                <td class="py-3 text-xs text-gray-400 whitespace-nowrap">
                                    {{ $activity->created_at->format('d/m H:i') }}
                                </td>
                                <td class="py-3 font-mono text-xs text-gray-700 dark:text-gray-300 max-w-xs truncate">
                                    {{ $activity->tool_name }}
                                </td>
                                <td class="py-3 text-xs">
                                    @if($activity->user)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 font-medium">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                            {{ $activity->user->name }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">Invitado</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</x-app-layout>
