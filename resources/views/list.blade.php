<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-700 text-indigo-700 dark:text-slate-100">

    <div class="container mx-auto mt-4">
     <h1 class="text-3xl tracking-wider">Notizen</h1>
    </div>

    <div class="container mx-auto mt-6 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-4">Neue Notiz erstellen</h2>
        <form action="/notes" method="POST" class="space-y-4">
            <!-- CSRF-Token (falls Laravel genutzt wird) -->
            @csrf
            <div>
                <label for="title" class="block text-sm font-medium">Titel</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    class="mt-1 block w-full px-4 py-2 border border-white rounded-lg shadow-sm focus:ring-white focus:border-white dark:bg-gray-700 dark:text-white dark:border-gray-600"
                    placeholder="Gib den Titel ein"
                    required
                >
            </div>

            <div>
                <label for="content" class="block text-sm font-medium">Inhalt</label>
                <textarea
                    id="content"
                    name="content"
                    rows="5"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                    placeholder="Schreibe hier den Inhalt deiner Notiz"
                    required
                ></textarea>
            </div>

            <div class="text-right">
                <button
                    type="submit"
                    class="px-6 py-2 bg-orange-500 text-white font-medium rounded-lg shadow hover:bg-orange-400 focus:ring focus:ring-orange-300 dark:bg-orange-500 dark:hover:bg-orange-400">
                    Speichern
                </button>
            </div>
        </form>
    </div>

    <div class="flex flex-col container mx-auto mt-2 space-y-2">
        @foreach ($notes as $note)
        <div class="bg-gray-800 rounded p-2 flex space-x-3 items-center justify-between">
            <div>
                <a class="text-xl text-orange-500" href="/notes/{{$note->id }}">{{ $note->title }}</a>
                <p class="dark:text-white">{!! $note->content !!}</p>
            </div>
            <div>
                <form action="{{ route('notes.destroy', $note->id) }}" method="post">

                    @csrf
                    @method('DELETE')

                    <button>
                        <x-Trash />
                        <span class="sr-only">{{__('Delete note')}}</span>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>
