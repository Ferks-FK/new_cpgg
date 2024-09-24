<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>{{ setting('site_name', config('app.name')) }}</title>
    @vite('resources/css/app.css')
</head>
<body x-cloak x-data="installer()" class="text-white bg-gray-700">
    <div class="flex items-center justify-center h-screen px-4">
        <div class="w-full max-w-3xl p-4 bg-gray-600 rounded-lg shadow-lg">
            <h1 class="mb-5 text-xl font-bold text-center">Panel Installer</h1>
            <ol class="flex flex-col border-t select-none rounded-t-xl border-x border-slate-500">
                <li class="pl-6 border-b border-slate-500">
                    <div
                        class="flex items-center gap-4 py-3"
                        x-bind:class="{
                            'text-blue-400': isStepActive('requirements'),
                            'text-emerald-400': isStepCompleted('requirements')
                        }"
                    >
                        <div
                            class="flex items-center justify-center w-8 h-8 bg-gray-500 border-2 rounded-full"
                            x-bind:class="{
                                'border-blue-400': isStepActive('requirements'),
                                'border-emerald-400': isStepCompleted('requirements')
                            }"
                        >
                            <span class="text-sm font-medium">01</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-medium">Enviroment Requirements</span>
                        </div>
                    </div>
                </li>
                <li class="pl-6 border-b border-slate-500">
                    <div
                        class="flex items-center gap-4 py-3"
                        x-bind:class="{
                            'text-blue-400': isStepActive('database'),
                            'text-emerald-400': isStepCompleted('database')

                        }"
                    >
                        <div
                            class="flex items-center justify-center w-8 h-8 bg-gray-500 border-2 rounded-full"
                            x-bind:class="{
                                'border-blue-400': isStepActive('database'),
                                'border-emerald-400': isStepCompleted('database')
                            }"
                        >
                            <span class="text-sm font-medium">02</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-medium">Database</span>
                        </div>
                    </div>
                </li>
                <li class="pl-6 border-b border-slate-500">
                    <div
                        class="flex items-center gap-4 py-3"
                        x-bind:class="{
                            'text-blue-400': isStepActive('enviroment'),
                            'text-emerald-400': isStepCompleted('enviroment')
                        }"
                    >
                        <div
                            class="flex items-center justify-center w-8 h-8 bg-gray-500 border-2 rounded-full"
                            x-bind:class="{
                                'border-blue-400': isStepActive('enviroment'),
                                'border-emerald-400': isStepCompleted('enviroment')
                            }"
                        >
                            <span class="text-sm font-medium">03</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-medium">Enviroment</span>
                        </div>
                    </div>
                </li>
                <li class="pl-6 border-b border-slate-500">
                    <div
                        class="flex items-center gap-4 py-3"
                        x-bind:class="{
                            'text-blue-400': isStepActive('account'),
                            'text-emerald-400': isStepCompleted('account')
                        }"
                    >
                        <div
                            class="flex items-center justify-center w-8 h-8 bg-gray-500 border-2 rounded-full"
                            x-bind:class="{
                                'border-blue-400': isStepActive('account'),
                                'border-emerald-400': isStepCompleted('account')
                            }"
                        >
                            <span class="text-sm font-medium">04</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-medium">Account</span>
                        </div>
                    </div>
                </li>
            </ol>
            <div class="px-6 py-3 border-b border-x rounded-b-xl border-slate-500">
                @yield('content')
            </div>
        </div>
    </div>
    <x-toast />
    @vite('resources/js/installer/installer.js')
</body>
