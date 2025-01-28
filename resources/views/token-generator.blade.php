<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Token Generator</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-700 text-indigo-700 dark:text-slate-100">

<div class="container mx-auto mt-4">
    <h1 class="text-3xl tracking-wider">Token Generator</h1>
</div>

<div class="container mx-auto mt-6 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold mb-4">Token für Benutzer erstellen</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded my-4 dark:bg-green-900 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('generate.token') }}" method="POST" class="space-y-4">
        @csrf <!-- CSRF-Schutz -->

        <!-- Benutzer-ID -->
        <div>
            <label for="user_id" class="block text-sm font-medium">Benutzer ID</label>
            <input
                type="text"
                id="user_id"
                name="user_id"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                placeholder="Gib die Benutzer-ID ein"
                required
            >
        </div>

        <!-- Checkboxen für Token erstellung -->
        <div>
            <p class="block text-sm font-medium">Token Typ:</p>
            <div class="flex items-center mb-2">
                <input
                    type="checkbox"
                    id="login-all"
                    name="token_all"
                    value="1"
                    class="h-4 w-4 text-orange-500 focus:ring-orange-400 focus:border-orange-400 dark:focus:ring-orange-500 border-gray-300 rounded">
                <label for="login-all" class="ml-2 dark:text-white">Login All</label>
            </div>
            <div class="flex items-center">
                <input
                    type="checkbox"
                    id="login-single"
                    name="token_single"
                    value="1"
                    class="h-4 w-4 text-orange-500 focus:ring-orange-400 focus:border-orange-400 dark:focus:ring-orange-500 border-gray-300 rounded">
                <label for="login-single" class="ml-2 dark:text-white">Login Single</label>
            </div>
        </div>

        <!-- Button zum Token generieren -->
        <div class="text-right">
            <button
                type="submit"
                class="px-6 py-2 bg-orange-500 text-white font-medium rounded-lg shadow hover:bg-orange-400 focus:ring focus:ring-orange-300 dark:bg-orange-500 dark:hover:bg-orange-400">
                Generieren
            </button>
        </div>
    </form>
</div>
</body>
</html>
