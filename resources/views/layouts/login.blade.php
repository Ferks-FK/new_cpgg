<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>{{ setting('app_name', config('app.name')) }}</title>
    @vite('resources/css/app.css')
</head>
<body x-cloak x-data class="text-white">
    <div class="flex flex-col items-center justify-center text-white bg-gray-700 size-full">
        @yield('content')
    </div>
    <x-toast />
    @vite('resources/js/app.js')
</body>
