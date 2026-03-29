<x-app-layout>
    @section('title', 'Laravel Route Generator - DevHub Tools')
    @section('meta_tags')
        <meta name="description" content="Visually build and scaffold out your Laravel web.php or api.php routes.">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laravel Route Generator') }}
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label for="routeMethod" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Method</label>
                    <select id="routeMethod" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm rounded-md">
                        <option value="get">GET</option>
                        <option value="post">POST</option>
                        <option value="put">PUT</option>
                        <option value="patch">PATCH</option>
                        <option value="delete">DELETE</option>
                    </select>
                </div>

                <div>
                    <label for="routePath" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Path</label>
                    <input type="text" id="routePath" placeholder="/users/{id}" class="mt-1 flex-1 shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md py-2 px-3">
                </div>

                <div>
                    <label for="routeController" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Controller Name</label>
                    <input type="text" id="routeController" placeholder="UserController" class="mt-1 flex-1 shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md py-2 px-3">
                </div>
                
                <div>
                    <label for="routeAction" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Action (Method Name)</label>
                    <input type="text" id="routeAction" placeholder="show" class="mt-1 flex-1 shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md py-2 px-3">
                </div>

                <div class="pt-4">
                    <button type="button" id="generateBtn" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors">
                        Generate Route Code
                    </button>
                </div>
            </div>

            <div class="flex flex-col h-full">
                <label for="routeOutput" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Generated Output</label>
                <div class="flex-1 overflow-auto bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-md p-4 relative min-h-[150px]">
                    <pre id="routeOutput" class="font-mono text-sm leading-relaxed text-gray-800 dark:text-orange-400"></pre>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('generateBtn').addEventListener('click', function() {
            const method = document.getElementById('routeMethod').value;
            const path = document.getElementById('routePath').value.trim() || '/';
            const controller = document.getElementById('routeController').value.trim() || 'Controller';
            const action = document.getElementById('routeAction').value.trim() || 'index';
            
            const routeStr = `Route::${method}('${path}', [${controller}::class, '${action}']);`;
            
            document.getElementById('routeOutput').textContent = "use App\\Http\\Controllers\\" + controller + ";\n\n" + routeStr;
            
            // Track Usage via AJAX
            fetch('{{ route("api.tool-usage") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    tool_name: 'Route Generator',
                    input_data: JSON.stringify({ method, path, controller, action })
                })
            }).catch(console.error);
        });
    </script>
    @endpush
</x-app-layout>
