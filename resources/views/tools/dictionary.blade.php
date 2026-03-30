<x-app-layout>
    @section('title', 'Diccionario de Código y Programación – HTML, CSS, PHP, JS, SQL | DevHub.Tools')
    @section('meta_description', 'Diccionario técnico para desarrolladores: significado de etiquetas HTML, funciones PHP, métodos JavaScript, keywords SQL, propiedades CSS, variables y más. Cualquier término de cualquier lenguaje.')
    @section('meta_keywords', 'diccionario de programacion, significado etiquetas html, que significa foreach php, que es una variable, definicion sql select, javascript array methods, css flexbox significado, diccionario tecnico desarrolladores, glosario programacion')

    <x-slot name="header">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white">📖 Diccionario de Código</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Busca el significado de cualquier término, etiqueta, función o variable de cualquier lenguaje</p>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Search Panel -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm ring-1 ring-gray-200 dark:ring-gray-700 p-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label for="dictQuery" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">¿Qué término deseas consultar?</label>
                    <input type="text" id="dictQuery"
                           class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm shadow-sm focus:ring-orange-500 focus:border-orange-500 py-2.5 px-4"
                           placeholder="Ej: array_map, SELECT, display: flex, useState, dto, null, polymorphism...">
                </div>
                <div class="md:w-52">
                    <label for="dictLang" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Idioma de respuesta</label>
                    <select id="dictLang" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm shadow-sm focus:ring-orange-500 focus:border-orange-500 py-2.5">
                        <option value="Español" selected>🇪🇸 Español</option>
                        <option value="English">🇺🇸 English</option>
                        <option value="Português">🇧🇷 Português</option>
                        <option value="Français">🇫🇷 Français</option>
                        <option value="Deutsch">🇩🇪 Deutsch</option>
                        <option value="Italiano">🇮🇹 Italiano</option>
                        <option value="中文">🇨🇳 中文</option>
                        <option value="Русский">🇷🇺 Русский</option>
                    </select>
                </div>
                <div class="md:self-end">
                    <button id="dictBtn" class="w-full px-6 py-2.5 bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors flex items-center gap-2">
                        <svg id="dictSpinner" class="animate-spin h-4 w-4 hidden" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                        <span id="dictBtnText">Buscar 🔍</span>
                    </button>
                </div>
            </div>

            <!-- Quick Search Tags -->
            <div class="mt-4">
                <p class="text-xs text-gray-400 mb-2 font-medium">Búsquedas frecuentes:</p>
                <div class="flex flex-wrap gap-2" id="quickTags">
                    @foreach(['forEach','SELECT JOIN','display: flex','useState','NULL','async/await','PRIMARY KEY','array_map','git merge','recursion','closure','API REST','ORM','SOLID','DTOs'] as $term)
                        <button class="quick-tag px-2.5 py-1 bg-orange-50 dark:bg-orange-900/20 text-orange-700 dark:text-orange-300 text-xs rounded-lg border border-orange-200 dark:border-orange-800 hover:bg-orange-100 dark:hover:bg-orange-900/40 transition-colors font-mono">
                            {{ $term }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Result Panel -->
        <div id="dictResult" class="hidden bg-white dark:bg-gray-800 rounded-2xl shadow-sm ring-1 ring-gray-200 dark:ring-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-orange-500 to-amber-500 px-6 py-4 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold text-white" id="resultTitle">Resultado</h2>
                    <p class="text-orange-100 text-xs" id="resultSubtitle"></p>
                </div>
                <button id="copyDictBtn" class="px-3 py-1.5 bg-white/20 hover:bg-white/30 text-white text-xs rounded-lg transition-colors">📋 Copiar</button>
            </div>
            <div class="p-6">
                <div id="dictError" class="hidden mb-4 p-3 border-l-4 border-red-500 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 text-sm rounded-r-lg"></div>
                <pre id="dictOutput" class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap font-sans"></pre>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    const dictBtn = document.getElementById('dictBtn');
    const dictBtnText = document.getElementById('dictBtnText');
    const dictSpinner = document.getElementById('dictSpinner');
    const dictQuery = document.getElementById('dictQuery');
    const dictLang = document.getElementById('dictLang');
    const dictOutput = document.getElementById('dictOutput');
    const dictResult = document.getElementById('dictResult');
    const resultTitle = document.getElementById('resultTitle');
    const resultSubtitle = document.getElementById('resultSubtitle');
    const dictErr = document.getElementById('dictError');

    // Quick tags
    document.querySelectorAll('.quick-tag').forEach(tag => {
        tag.addEventListener('click', () => {
            dictQuery.value = tag.textContent.trim();
            search();
        });
    });

    // Enter key
    dictQuery.addEventListener('keydown', e => { if (e.key === 'Enter') search(); });

    dictBtn.addEventListener('click', search);

    document.getElementById('copyDictBtn').addEventListener('click', () => {
        if (dictOutput.textContent) navigator.clipboard.writeText(dictOutput.textContent);
    });

    async function search() {
        const query = dictQuery.value.trim();
        if (!query) return;

        dictBtn.disabled = true;
        dictBtnText.textContent = 'Buscando...';
        dictSpinner.classList.remove('hidden');
        dictErr.classList.add('hidden');
        dictResult.classList.remove('hidden');
        resultTitle.textContent = `"${query}"`;
        resultSubtitle.textContent = `Definición en ${dictLang.value}`;
        dictOutput.textContent = '⏳ Consultando diccionario IA...';

        try {
            const res = await fetch('{{ route("api.ai-tool") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ mode: 'dictionary', input: query, from: dictLang.value, to: '' })
            });
            const data = await res.json();
            if (data.success) { dictOutput.textContent = data.data; }
            else { throw new Error(data.message); }
        } catch(e) {
            dictOutput.textContent = '';
            dictErr.textContent = e.message;
            dictErr.classList.remove('hidden');
        } finally {
            dictBtn.disabled = false;
            dictBtnText.textContent = 'Buscar 🔍';
            dictSpinner.classList.add('hidden');
        }
    }
    </script>
    @endpush
</x-app-layout>
