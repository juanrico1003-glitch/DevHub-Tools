<x-app-layout>
    @section('title', 'Traductor de Idiomas Online Gratis – Todos los Idiomas del Mundo | DevHub.Tools')
    @section('meta_description', 'Traduce texto entre todos los idiomas del mundo gratis: español, inglés, francés, alemán, chino, japonés, árabe, ruso, portugués y más de 100 idiomas. Potenciado por Google Gemini AI.')
    @section('meta_keywords', 'traductor de idiomas online gratis, traducir texto español ingles, traductor automatico todos los idiomas, translating texto, traduccion instantanea, google translate alternativa, traductor con inteligencia artificial')

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white">🌍 Traductor de Idiomas</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Todos los idiomas del mundo – Potenciado por Google Gemini AI</p>
            </div>
            <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-bold">✨ AI</span>
        </div>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm ring-1 ring-gray-200 dark:ring-gray-700 p-6">
        <!-- Controls Row -->
        <div class="flex flex-col md:flex-row items-end gap-4 mb-6">
            <div class="flex-1">
                <label for="srcLang" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Idioma de origen</label>
                <select id="srcLang" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2.5">
                    @php
                    $languages = [
                        'Español','English','Français','Deutsch','Italiano','Português','Русский','中文 (简体)',
                        '中文 (繁體)','日本語','한국어','العربية','हिन्दी','বাংলা','Kiswahili','Türkçe',
                        'Tiếng Việt','Bahasa Indonesia','Bahasa Melayu','ภาษาไทย','Tagalog','Polski',
                        'Čeština','Magyar','Română','Nederlands','Svenska','Norsk','Dansk','Suomi',
                        'Ελληνικά','Català','עברית','فارسی','اردو','Українська','Беларуская','Latviešu',
                        'Lietuvių','Eesti','Slovenčina','Slovenščina','Hrvatski','Srpski','Bosanski',
                        'Makedonski','Shqip','Հայերեն','ქართული','Azərbaycan','Қазақ','Монгол',
                        'Burmese','Sinhalese','Nepali','Pashto','Amharic','Yoruba','Igbo','Hausa',
                        'Zulu','Afrikaans','Latin','Welsh','Irish','Basque','Galician'
                    ];
                    @endphp
                    @foreach($languages as $lang)
                        <option value="{{ $lang }}" {{ $lang === 'Español' ? 'selected' : '' }}>{{ $lang }}</option>
                    @endforeach
                </select>
            </div>

            <button id="swapLangs" class="p-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:border-blue-400 hover:text-blue-600 transition-colors flex-shrink-0" title="Intercambiar idiomas">
                ⇄
            </button>

            <div class="flex-1">
                <label for="tgtLang" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Idioma de destino</label>
                <select id="tgtLang" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2.5">
                    @foreach($languages as $lang)
                        <option value="{{ $lang }}" {{ $lang === 'English' ? 'selected' : '' }}>{{ $lang }}</option>
                    @endforeach
                </select>
            </div>

            <button id="translateBtn" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors flex items-center gap-2 flex-shrink-0">
                <svg id="translateSpinner" class="animate-spin h-4 w-4 hidden" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                <span id="translateBtnText">Traducir 🌍</span>
            </button>
        </div>

        <!-- Error -->
        <div id="langError" class="hidden mb-4 p-3 border-l-4 border-red-500 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 text-sm rounded-r-lg"></div>

        <!-- Editor -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 h-[420px]">
            <div class="flex flex-col h-full ring-1 ring-gray-200 dark:ring-gray-700 rounded-xl overflow-hidden">
                <div class="bg-gray-50 dark:bg-gray-900 px-4 py-2 text-xs font-semibold text-gray-400 uppercase border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <span>Texto original</span>
                    <button id="clearBtn" class="text-gray-400 hover:text-red-500 transition-colors text-xs">✕ Limpiar</button>
                </div>
                <textarea id="sourceText" class="flex-1 w-full border-0 focus:ring-0 resize-none p-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 text-sm leading-relaxed" placeholder="Escribe o pega el texto que deseas traducir..."></textarea>
            </div>
            <div class="flex flex-col h-full ring-1 ring-gray-200 dark:ring-gray-700 rounded-xl overflow-hidden">
                <div class="bg-gray-50 dark:bg-gray-900 px-4 py-2 text-xs font-semibold text-gray-400 uppercase border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <span>Traducción</span>
                    <button id="copyLangBtn" class="text-gray-400 hover:text-blue-500 transition-colors text-xs">📋 Copiar</button>
                </div>
                <div class="flex-1 w-full p-4 bg-gray-50 dark:bg-gray-900 overflow-auto">
                    <p id="translationOutput" class="text-gray-800 dark:text-blue-300 text-sm leading-relaxed whitespace-pre-wrap"></p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    const translateBtn = document.getElementById('translateBtn');
    const translateBtnText = document.getElementById('translateBtnText');
    const translateSpinner = document.getElementById('translateSpinner');
    const srcLang = document.getElementById('srcLang');
    const tgtLang = document.getElementById('tgtLang');
    const sourceText = document.getElementById('sourceText');
    const output = document.getElementById('translationOutput');
    const errorDiv = document.getElementById('langError');

    document.getElementById('swapLangs').addEventListener('click', () => {
        const tmp = srcLang.value;
        srcLang.value = tgtLang.value;
        tgtLang.value = tmp;
        const tmpText = sourceText.value;
        sourceText.value = output.textContent;
        output.textContent = tmpText;
    });

    document.getElementById('clearBtn').addEventListener('click', () => { sourceText.value = ''; output.textContent = ''; });

    document.getElementById('copyLangBtn').addEventListener('click', () => {
        if (output.textContent) navigator.clipboard.writeText(output.textContent);
    });

    translateBtn.addEventListener('click', async () => {
        const text = sourceText.value.trim();
        if (!text) return;

        translateBtn.disabled = true;
        translateBtnText.textContent = 'Traduciendo...';
        translateSpinner.classList.remove('hidden');
        errorDiv.classList.add('hidden');
        output.textContent = '⏳ Procesando con IA...';

        try {
            const res = await fetch('{{ route("api.ai-tool") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ mode: 'language-translate', input: text, from: srcLang.value, to: tgtLang.value })
            });
            const data = await res.json();
            if (data.success) { output.textContent = data.data; }
            else { throw new Error(data.message); }
        } catch(e) {
            output.textContent = '';
            errorDiv.textContent = e.message;
            errorDiv.classList.remove('hidden');
        } finally {
            translateBtn.disabled = false;
            translateBtnText.textContent = 'Traducir 🌍';
            translateSpinner.classList.add('hidden');
        }
    });
    </script>
    @endpush
</x-app-layout>
