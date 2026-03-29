<x-app-layout>
    @section('title', 'JSON Formatter & Validator - DevHub Tools')
    @section('meta_tags')
        <meta name="description" content="Format, validate, and beautify your JSON data online with DevHub Tools.">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('JSON Formatter & Editor') }}
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 h-[600px]">
            <div class="flex flex-col h-full">
                <label for="jsonInput" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Raw JSON Data</label>
                <textarea id="jsonInput" class="flex-1 shadow-sm focus:ring-emerald-500 focus:border-emerald-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md p-4 font-mono text-sm leading-relaxed" placeholder='{"key": "value"}'></textarea>
                <div class="mt-4">
                    <button type="button" id="formatBtn" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors">
                        Format / Validate JSON
                    </button>
                    <p id="errorMsg" class="mt-2 text-sm text-red-500 hidden"></p>
                </div>
            </div>

            <div class="flex flex-col h-full">
                <label for="jsonOutput" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Formatted Result</label>
                <div class="flex-1 overflow-auto bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-md p-4 relative">
                    <pre id="jsonOutput" class="font-mono text-sm leading-relaxed text-gray-800 dark:text-emerald-400"></pre>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('formatBtn').addEventListener('click', function() {
            const rawData = document.getElementById('jsonInput').value.trim();
            const errorMsg = document.getElementById('errorMsg');
            const outputView = document.getElementById('jsonOutput');
            
            errorMsg.classList.add('hidden');
            if (!rawData) return;

            try {
                const parsed = JSON.parse(rawData);
                const formatted = JSON.stringify(parsed, null, 4);
                
                outputView.textContent = formatted;
                
                // Track Usage via AJAX
                fetch('{{ route("api.tool-usage") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        tool_name: 'JSON Formatter',
                        // Avoid sending massive JSON to DB, limit to first 1000 chars for telemetry
                        input_data: rawData.substring(0, 1000)
                    })
                }).catch(console.error);
                
            } catch (e) {
                errorMsg.textContent = 'Invalid JSON: ' + e.message;
                errorMsg.classList.remove('hidden');
            }
        });
    </script>
    @endpush
</x-app-layout>
