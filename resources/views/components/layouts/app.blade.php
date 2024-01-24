<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased">

<x-cms::header />

<main class="my-16">
    <div class="max-w-7xl mx-auto px-8">
        {{ $slot }}
    </div>
</main>

<x-cms::footer />

@include('cookie-consent::index')

</body>
</html>
