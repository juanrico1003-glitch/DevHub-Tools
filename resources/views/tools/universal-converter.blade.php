<x-app-layout>
    @section('title', 'Universal AI Code Converter & Translator')
    @section('meta_tags')
        <meta name="description" content="AI-powered code translation. Convert CSS to Tailwind, PHP to JS, SQL to Eloquent, and more instantly.">
    @endsection

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Universal Code Translator') }}
            </h2>
            <span class="inline-flex items-center rounded-md bg-purple-50 dark:bg-purple-900/30 px-2.5 py-1 text-xs font-semibold text-purple-700 dark:text-purple-400 ring-1 ring-inset ring-purple-700/10">
                Powered by AI
            </span>
        </div>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 mt-4">
        
        <!-- Controls Header -->
        <div class="flex flex-col md:flex-row items-center justify-between mb-6 space-y-4 md:space-y-0 md:space-x-4">
            
            <!-- Source Selector -->
            <div class="w-full md:w-1/3">
                <label for="sourceLanguage" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Translate From</label>
                <select id="sourceLanguage" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-md shadow-sm">
                    <option value="SQL" selected>SQL</option>
                    <option value="Laravel Eloquent">Laravel Eloquent</option>
                    <option value="Vanilla CSS">Vanilla CSS</option>
                    <option value="Tailwind CSS">Tailwind CSS</option>
                    <option value="Bootstrap">Bootstrap</option>
                    <option value="PHP">PHP</option>
                    <option value="JavaScript">JavaScript</option>
                    <option value="Laravel">Laravel framework</option>
                    <option value="React">React framework</option>
                    <option value="Python">Python</option>
                    <option value="Java">Java</option>
                    <option value="XML">XML</option>
                    <option value="HTML">HTML</option>
                </select>
            </div>

            <!-- Swap Button -->
            <div class="flex-shrink-0 mt-4 md:mt-0 items-end hidden md:flex h-full pb-1">
                <button type="button" id="swapBtn" class="p-2 border border-gray-300 dark:border-gray-600 rounded-full bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors" title="Swap languages">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                </button>
            </div>

            <!-- Target Selector -->
            <div class="w-full md:w-1/3">
                <label for="targetLanguage" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Translate To</label>
                <select id="targetLanguage" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-md shadow-sm">
                    <option value="SQL">SQL</option>
                    <option value="Laravel Eloquent" selected>Laravel Eloquent</option>
                    <option value="Vanilla CSS">Vanilla CSS</option>
                    <option value="Tailwind CSS">Tailwind CSS</option>
                    <option value="Bootstrap">Bootstrap</option>
                    <option value="PHP">PHP</option>
                    <option value="JavaScript">JavaScript</option>
                    <option value="Laravel">Laravel framework</option>
                    <option value="React">React framework</option>
                    <option value="Python">Python</option>
                    <option value="Java">Java</option>
                    <option value="XML">XML</option>
                    <option value="HTML">HTML</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="w-full md:w-auto md:self-end">
                <button type="button" id="convertBtn" class="w-full inline-flex items-center justify-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors h-[42px]">
                    <span id="btnText">Convert Code ✨</span>
                    <svg id="btnSpinner" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                </button>
            </div>
        </div>

        <div id="errorContainer" class="hidden mb-4 p-4 border-l-4 border-red-500 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-sm"></div>

        <!-- Editor Area -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 h-[500px]">
            <!-- Input -->
            <div class="flex flex-col h-full ring-1 ring-gray-200 dark:ring-gray-700 rounded-md overflow-hidden shadow-sm">
                <div class="bg-gray-100 dark:bg-gray-900 px-4 py-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide border-b border-gray-200 dark:border-gray-700">Source Code</div>
                <textarea id="sourceCode" class="flex-1 w-full border-0 focus:ring-0 resize-none p-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 font-mono text-sm leading-relaxed" placeholder="Pega el código original aquí..."></textarea>
            </div>

            <!-- Output -->
            <div class="flex flex-col h-full ring-1 ring-gray-200 dark:ring-gray-700 rounded-md overflow-hidden shadow-sm">
                <div class="bg-gray-100 dark:bg-gray-900 px-4 py-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide border-b border-gray-200 dark:border-gray-700">Converted Output</div>
                <div class="flex-1 w-full p-4 bg-gray-50 dark:bg-gray-900 overflow-auto relative group">
                    <button id="copyBtn" class="absolute top-2 right-2 p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-sm text-gray-500 dark:text-gray-400 hover:text-purple-600 focus:outline-none opacity-0 group-hover:opacity-100 transition-opacity" title="Copy to clipboard">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                    </button>
                    <pre id="outputCode" class="m-0 font-mono text-sm leading-relaxed text-gray-800 dark:text-purple-400 break-words whitespace-pre-wrap"></pre>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
    <script>
        const btn = document.getElementById('convertBtn');
        const btnText = document.getElementById('btnText');
        const btnSpinner = document.getElementById('btnSpinner');
        const sourceCode = document.getElementById('sourceCode');
        const outputCode = document.getElementById('outputCode');
        const sourceLang = document.getElementById('sourceLanguage');
        const targetLang = document.getElementById('targetLanguage');
        const errorContainer = document.getElementById('errorContainer');
        const swapBtn = document.getElementById('swapBtn');
        const copyBtn = document.getElementById('copyBtn');

        // Swap function
        swapBtn.addEventListener('click', () => {
            const tempVal = sourceLang.value;
            sourceLang.value = targetLang.value;
            targetLang.value = tempVal;
            
            // Optionally swap text areas too if the output is not empty
            if(outputCode.textContent && !sourceCode.value.includes('Pega el código')){
                const tempCode = sourceCode.value;
                sourceCode.value = outputCode.textContent;
                outputCode.textContent = tempCode;
            }
        });

        // Copy functionality
        copyBtn.addEventListener('click', () => {
            if(outputCode.textContent) {
                navigator.clipboard.writeText(outputCode.textContent);
                const originalSvg = copyBtn.innerHTML;
                copyBtn.innerHTML = '<svg class="h-4 w-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                setTimeout(() => { copyBtn.innerHTML = originalSvg; }, 2000);
            }
        });

        // API Call
        btn.addEventListener('click', async () => {
            const codeModeStr = sourceCode.value.trim();
            if(!codeModeStr) return;

            // Load UI
            btn.disabled = true;
            btnText.textContent = 'Converting...';
            btnSpinner.classList.remove('hidden');
            errorContainer.classList.add('hidden');
            outputCode.textContent = '';
            outputCode.classList.add('animate-pulse');
            outputCode.textContent = 'Traduciendo lógica con IA... por favor espera unos segundos.';

            try {
                const response = await fetch('{{ route("api.code.convert") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        source_code: codeModeStr,
                        source_type: sourceLang.value,
                        target_type: targetLang.value
                    })
                });

                const data = await response.json();
                
                outputCode.classList.remove('animate-pulse');

                if(response.ok && data.success) {
                    outputCode.textContent = data.data;
                } else {
                    throw new Error(data.message || 'Se produjo un error durante la conversión.');
                }
            } catch (error) {
                outputCode.textContent = '';
                errorContainer.textContent = error.message;
                errorContainer.classList.remove('hidden');
            } finally {
                btn.disabled = false;
                btnText.textContent = 'Convert Code ✨';
                btnSpinner.classList.add('hidden');
                outputCode.classList.remove('animate-pulse');
            }
        });
    </script>
    @endpush
</x-app-layout>
