<x-app-layout>
    @section('title', 'Conversor de Bases de Datos: MySQL, PostgreSQL, MongoDB, SQLite | DevHub.Tools')
    @section('meta_description', 'Convierte schemas y queries entre bases de datos relacionales y no relacionales: MySQL a MongoDB, SQL a PostgreSQL, SQLite a MySQL, MySQL a Firestore. Potenciado por IA.')
    @section('meta_keywords', 'convertir mysql a mongodb, sql a nosql, mysql a postgresql, sqlite a mysql, migrar base de datos, schema converter, sql to mongodb query, mysql to firestore, database migration tool')

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white">🗄️ Conversor de Bases de Datos</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Relacionales y No Relacionales – MySQL, PostgreSQL, MongoDB, SQLite, Firestore</p>
            </div>
        </div>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm ring-1 ring-gray-200 dark:ring-gray-700 p-6">
        <!-- Controls -->
        <div class="flex flex-col md:flex-row items-end gap-4 mb-6">
            <div class="flex-1">
                <label for="dbSource" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Base de datos origen</label>
                <select id="dbSource" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm shadow-sm focus:ring-green-500 focus:border-green-500 py-2.5">
                    <optgroup label="Relacionales (SQL)">
                        <option value="MySQL" selected>MySQL</option>
                        <option value="PostgreSQL">PostgreSQL</option>
                        <option value="SQLite">SQLite</option>
                        <option value="SQL Server">SQL Server (T-SQL)</option>
                        <option value="Oracle SQL">Oracle SQL</option>
                        <option value="MariaDB">MariaDB</option>
                    </optgroup>
                    <optgroup label="No Relacionales (NoSQL)">
                        <option value="MongoDB">MongoDB</option>
                        <option value="Firebase Firestore">Firebase Firestore</option>
                        <option value="DynamoDB">Amazon DynamoDB</option>
                        <option value="Cassandra">Cassandra CQL</option>
                        <option value="Redis">Redis</option>
                        <option value="CouchDB">CouchDB</option>
                    </optgroup>
                    <optgroup label="ORM / Query Builders">
                        <option value="Laravel Eloquent ORM">Laravel Eloquent ORM</option>
                        <option value="Doctrine ORM">Doctrine ORM (PHP)</option>
                        <option value="Mongoose (Node.js)">Mongoose (Node.js)</option>
                        <option value="Sequelize (Node.js)">Sequelize (Node.js)</option>
                        <option value="SQLAlchemy (Python)">SQLAlchemy (Python)</option>
                        <option value="Prisma">Prisma (TypeScript)</option>
                    </optgroup>
                </select>
            </div>

            <button id="swapDb" class="p-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-500 hover:bg-green-50 hover:border-green-400 hover:text-green-600 transition-colors flex-shrink-0">⇄</button>

            <div class="flex-1">
                <label for="dbTarget" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Base de datos destino</label>
                <select id="dbTarget" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm shadow-sm focus:ring-green-500 focus:border-green-500 py-2.5">
                    <optgroup label="No Relacionales (NoSQL)">
                        <option value="MongoDB" selected>MongoDB</option>
                        <option value="Firebase Firestore">Firebase Firestore</option>
                        <option value="DynamoDB">Amazon DynamoDB</option>
                        <option value="Cassandra">Cassandra CQL</option>
                        <option value="Redis">Redis</option>
                        <option value="CouchDB">CouchDB</option>
                    </optgroup>
                    <optgroup label="Relacionales (SQL)">
                        <option value="MySQL">MySQL</option>
                        <option value="PostgreSQL">PostgreSQL</option>
                        <option value="SQLite">SQLite</option>
                        <option value="SQL Server">SQL Server (T-SQL)</option>
                        <option value="Oracle SQL">Oracle SQL</option>
                        <option value="MariaDB">MariaDB</option>
                    </optgroup>
                    <optgroup label="ORM / Query Builders">
                        <option value="Laravel Eloquent ORM">Laravel Eloquent ORM</option>
                        <option value="Doctrine ORM">Doctrine ORM (PHP)</option>
                        <option value="Mongoose (Node.js)">Mongoose (Node.js)</option>
                        <option value="Sequelize (Node.js)">Sequelize (Node.js)</option>
                        <option value="SQLAlchemy (Python)">SQLAlchemy (Python)</option>
                        <option value="Prisma">Prisma (TypeScript)</option>
                    </optgroup>
                </select>
            </div>

            <button id="convertDbBtn" class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors flex items-center gap-2 flex-shrink-0">
                <svg id="dbSpinner" class="animate-spin h-4 w-4 hidden" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                <span id="dbBtnText">Convertir 🗄️</span>
            </button>
        </div>

        <div id="dbError" class="hidden mb-4 p-3 border-l-4 border-red-500 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 text-sm rounded-r-lg"></div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 h-[450px]">
            <div class="flex flex-col h-full ring-1 ring-gray-200 dark:ring-gray-700 rounded-xl overflow-hidden">
                <div class="bg-gray-50 dark:bg-gray-900 px-4 py-2 text-xs font-semibold text-gray-400 uppercase border-b border-gray-200 dark:border-gray-700">Schema / Query Original</div>
                <textarea id="dbSourceCode" class="flex-1 w-full border-0 focus:ring-0 resize-none p-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 font-mono text-sm leading-relaxed" placeholder="CREATE TABLE users (&#10;  id INT PRIMARY KEY AUTO_INCREMENT,&#10;  name VARCHAR(255) NOT NULL,&#10;  email VARCHAR(255) UNIQUE&#10;);"></textarea>
            </div>
            <div class="flex flex-col h-full ring-1 ring-gray-200 dark:ring-gray-700 rounded-xl overflow-hidden">
                <div class="bg-gray-50 dark:bg-gray-900 px-4 py-2 text-xs font-semibold text-gray-400 uppercase border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <span>Resultado Convertido</span>
                    <button id="copyDbBtn" class="text-gray-400 hover:text-green-500 text-xs transition-colors">📋 Copiar</button>
                </div>
                <div class="flex-1 overflow-auto p-4 bg-gray-50 dark:bg-gray-900">
                    <pre id="dbOutput" class="font-mono text-sm text-gray-800 dark:text-green-400 whitespace-pre-wrap break-words"></pre>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    const dbBtn = document.getElementById('convertDbBtn');
    const dbBtnText = document.getElementById('dbBtnText');
    const dbSpinner = document.getElementById('dbSpinner');
    const dbSource = document.getElementById('dbSource');
    const dbTarget = document.getElementById('dbTarget');
    const dbSrc = document.getElementById('dbSourceCode');
    const dbOut = document.getElementById('dbOutput');
    const dbErr = document.getElementById('dbError');

    document.getElementById('swapDb').addEventListener('click', () => {
        const tmp = dbSource.value;
        dbSource.value = dbTarget.value;
        dbTarget.value = tmp;
    });

    document.getElementById('copyDbBtn').addEventListener('click', () => {
        if (dbOut.textContent) navigator.clipboard.writeText(dbOut.textContent);
    });

    dbBtn.addEventListener('click', async () => {
        const code = dbSrc.value.trim();
        if (!code) return;

        dbBtn.disabled = true;
        dbBtnText.textContent = 'Convirtiendo...';
        dbSpinner.classList.remove('hidden');
        dbErr.classList.add('hidden');
        dbOut.textContent = '⏳ Procesando con IA...';

        try {
            const res = await fetch('{{ route("api.ai-tool") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ mode: 'database-convert', input: code, from: dbSource.value, to: dbTarget.value })
            });
            const data = await res.json();
            if (data.success) { dbOut.textContent = data.data; }
            else { throw new Error(data.message); }
        } catch(e) {
            dbOut.textContent = '';
            dbErr.textContent = e.message;
            dbErr.classList.remove('hidden');
        } finally {
            dbBtn.disabled = false;
            dbBtnText.textContent = 'Convertir 🗄️';
            dbSpinner.classList.add('hidden');
        }
    });
    </script>
    @endpush
</x-app-layout>
