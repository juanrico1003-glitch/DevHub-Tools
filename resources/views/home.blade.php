<x-app-layout>
    @section('title', 'DevHub.Tools – Herramientas IA para Desarrolladores | Code, Idiomas, BD, Diccionario')
    @section('meta_description', 'Plataforma gratuita de herramientas para programadores: Conversor de lenguajes (SQL↔Eloquent, PHP↔JS, Python↔Java), Traductor de idiomas (todos los idiomas del mundo), Convertidor de bases de datos (MySQL, PostgreSQL, MongoDB), Diccionario de código. Potenciado por Google Gemini AI.')
    @section('meta_keywords', 'conversor sql eloquent, traductor de idiomas gratis, convertir sql a mongodb, php a javascript, python a java, mysql a postgresql, diccionario de programacion, code translator online, sql to eloquent laravel, css to tailwind, bases de datos relacionales y no relacionales, convertidor de codigo gratis')

    <div class="py-2">
        <!-- Hero Section -->
        <div class="text-center mb-12 py-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-xs font-semibold mb-4">
                ✨ Potenciado por Google Gemini AI
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-4 leading-tight">
                Tu centro de herramientas<br>
                <span class="bg-gradient-to-r from-purple-600 to-indigo-500 bg-clip-text text-transparent">para desarrolladores</span>
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Convierte código, traduce idiomas, migra bases de datos y consulta términos técnicos. Todo en un solo lugar, gratis e impulsado por IA.
            </p>
        </div>

        <!-- Tools Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto">

            <!-- Code Translator -->
            <a href="{{ route('tool.universal') }}" class="group relative overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 ring-1 ring-gray-200 dark:ring-gray-700 hover:ring-purple-400">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-600/5 to-indigo-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-14 h-14 rounded-xl bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-2xl shadow-lg">💻</div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">Conversor de Código</h2>
                            <span class="px-1.5 py-0.5 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-[10px] font-bold rounded uppercase">IA</span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Convierte entre lenguajes de programación y frameworks al instante.</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(['SQL↔Eloquent','PHP↔JS','Python↔Java','CSS↔Tailwind','C++↔Rust','Laravel↔React'] as $tag)
                                <span class="px-2 py-0.5 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-[10px] rounded font-mono">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </a>

            <!-- Language Translator -->
            <a href="{{ route('tool.language') }}" class="group relative overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 ring-1 ring-gray-200 dark:ring-gray-700 hover:ring-blue-400">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600/5 to-cyan-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center text-2xl shadow-lg">🌍</div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Traductor de Idiomas</h2>
                            <span class="px-1.5 py-0.5 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-[10px] font-bold rounded uppercase">IA</span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Traduce texto entre todos los idiomas del mundo con IA avanzada.</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(['Español','English','Français','Deutsch','中文','日本語','العربية','Русский'] as $lang)
                                <span class="px-2 py-0.5 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-[10px] rounded">{{ $lang }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </a>

            <!-- Database Converter -->
            <a href="{{ route('tool.database') }}" class="group relative overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 ring-1 ring-gray-200 dark:ring-gray-700 hover:ring-green-400">
                <div class="absolute inset-0 bg-gradient-to-br from-green-600/5 to-emerald-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-14 h-14 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-2xl shadow-lg">🗄️</div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">Conversor de Bases de Datos</h2>
                            <span class="px-1.5 py-0.5 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-[10px] font-bold rounded uppercase">IA</span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Convierte schemas y queries entre BD relacionales y no relacionales.</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(['MySQL↔PostgreSQL','SQL↔MongoDB','SQLite↔MySQL','MySQL↔Firestore'] as $db)
                                <span class="px-2 py-0.5 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-[10px] rounded font-mono">{{ $db }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </a>

            <!-- Developer Dictionary -->
            <a href="{{ route('tool.dictionary') }}" class="group relative overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 ring-1 ring-gray-200 dark:ring-gray-700 hover:ring-orange-400">
                <div class="absolute inset-0 bg-gradient-to-br from-orange-600/5 to-amber-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-14 h-14 rounded-xl bg-gradient-to-br from-orange-500 to-amber-600 flex items-center justify-center text-2xl shadow-lg">📖</div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors">Diccionario de Código</h2>
                            <span class="px-1.5 py-0.5 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300 text-[10px] font-bold rounded uppercase">IA</span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Definición de etiquetas, variables, funciones y términos técnicos de cualquier lenguaje.</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(['HTML tags','PHP functions','SQL keywords','CSS properties','JS methods','Algoritmos'] as $term)
                                <span class="px-2 py-0.5 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-[10px] rounded">{{ $term }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </a>

        </div>

        <!-- SEO Text Block -->
        <div class="max-w-5xl mx-auto mt-16 p-8 bg-white dark:bg-gray-800 rounded-2xl ring-1 ring-gray-200 dark:ring-gray-700">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">¿Qué puedes hacer en DevHub.Tools?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600 dark:text-gray-400">
                <ul class="space-y-2">
                    <li>✅ Convertir SQL a Laravel Eloquent ORM</li>
                    <li>✅ Traducir código PHP a JavaScript y viceversa</li>
                    <li>✅ Convertir CSS a Tailwind CSS o Bootstrap</li>
                    <li>✅ Migrar schemas de MySQL a MongoDB</li>
                    <li>✅ Convertir Python a Java, Go, Rust, Swift</li>
                    <li>✅ Traducir de COBOL a cualquier lenguaje moderno</li>
                </ul>
                <ul class="space-y-2">
                    <li>✅ Traducir texto entre todos los idiomas del mundo</li>
                    <li>✅ Convertir schemas entre PostgreSQL y SQLite</li>
                    <li>✅ Buscar el significado de cualquier etiqueta HTML</li>
                    <li>✅ Consultar funciones de PHP, Python, JavaScript</li>
                    <li>✅ Entender términos de SQL, NoSQL y ORM</li>
                    <li>✅ Traducir documentación técnica a tu idioma</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
