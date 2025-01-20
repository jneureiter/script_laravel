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
<div class="container p-2 mx-auto mt-4">
    <h1 class="text-3xl tracking-wider">{{ $title }}</h1>

    <div class="bg-gray-200 rounded ">
        <p class="dark:text-gray-700">{!! $note->content !!}</p>
    </div>

    <p class="mt-4">
        <a class="block" href="/">zurück</a>
        </p>
    </div>
</body>
</html>
