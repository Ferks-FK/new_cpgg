<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>{{ setting('site_name', config('app.name')) }}</title>
    @vite('resources/css/app.css')
</head>
<body x-cloak x-data class="text-white bg-gray-700">
    @include('partials.header')
    @include('partials.sidebar')
    <div x-bind:class="$store.layout.sidebar.open ? 'ml-[250px]' : 'ml-0 md:ml-[70px]'" class="flex flex-col mt-[60px] pb-5">
        @yield('content')
    </div>
    <x-toast />
    @vite('resources/js/app.js')
</body>
