<x-app-layout>
    @section('title', 'SQL to Eloquent Converter - DevHub Tools')
    @section('meta_tags')
        <meta name="description" content="Convert your raw SQL queries into Laravel Eloquent Syntax instantly.">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('SQL to Eloquent Converter') }}
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="sqlInput" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Raw SQL Query</label>
                <div class="mt-1">
                    <textarea id="sqlInput" rows="10" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md p-4 font-mono text-sm leading-relaxed" placeholder="SELECT * FROM users WHERE status = 'active';"></textarea>
                </div>
                <div class="mt-4">
                    <button type="button" id="convertBtn" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        Convert to Eloquent
                    </button>
                </div>
            </div>

            <div>
                <label for="eloquentOutput" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Eloquent Syntax</label>
                <div class="mt-1">
                    <textarea id="eloquentOutput" rows="10" readonly class="shadow-sm block w-full sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-900 bg-gray-50 dark:text-green-400 text-green-700 rounded-md p-4 font-mono text-sm leading-relaxed"></textarea>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('convertBtn').addEventListener('click', function() {
            const sql = document.getElementById('sqlInput').value.trim();
            if (!sql) return;

            // Very basic simulated logic for demonstration MVP purposes
            let eloquent = sql;
            
            // SELECT * FROM table WHERE col = val
            const basicMatch = sql.match(/SELECT\s+\*\s+FROM\s+([a-zA-Z_]+)\s+WHERE\s+([a-zA-Z_]+)\s*=\s*(['"][\w\s]+['"])/i);
            
            if (basicMatch) {
                const table = basicMatch[1];
                const col = basicMatch[2];
                const val = basicMatch[3];
                eloquent = `DB::table('${table}')->where('${col}', ${val})->get();`;
            } else {
                eloquent = "// Complex conversion not supported in MVP.\n// This tool is for demonstration.";
            }

            document.getElementById('eloquentOutput').value = eloquent;

            // Track Usage via AJAX
            fetch('{{ route("api.tool-usage") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    tool_name: 'SQL to Eloquent',
                    input_data: sql
                })
            }).catch(console.error);
        });
    </script>
    @endpush
</x-app-layout>
