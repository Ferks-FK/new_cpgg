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
    <div class="flex items-center justify-center p-4 md:h-full">
        <div class="w-full max-w-6xl p-4 bg-gray-600 rounded-lg shadow-lg">
            <h1 class="mb-5 text-xl font-bold text-center">Panel Installer</h1>
            <ol class="flex flex-col w-full border-t select-none md:flex-row rounded-t-xl border-x border-slate-500">
                <li class="relative flex w-full pl-6 border-b border-slate-500">
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
                        <span class="flex-1 text-sm font-medium">Enviroment Requirements</span>
                    </div>
                    <div class="absolute hidden w-5 h-full end-0 md:block">
                        <svg fill="none" preserveAspectRatio="none" viewBox="0 0 22 80" class="w-full h-full text-slate-500">
                            <path d="M0 -2L20 40L0 82" stroke-linejoin="round" stroke="currentcolor" vector-effect="non-scaling-stroke"></path>
                        </svg>
                    </div>
                </li>
                <li class="relative flex w-full pl-6 border-b border-slate-500">
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
                        <span class="flex-1 text-sm font-medium">Database</span>
                    </div>
                    <div class="absolute hidden w-5 h-full end-0 md:block">
                        <svg fill="none" preserveAspectRatio="none" viewBox="0 0 22 80" class="w-full h-full text-slate-500">
                            <path d="M0 -2L20 40L0 82" stroke-linejoin="round" stroke="currentcolor" vector-effect="non-scaling-stroke"></path>
                        </svg>
                    </div>
                </li>
                <li class="relative flex w-full pl-6 border-b border-slate-500">
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
                        <span class="flex-1 text-sm font-medium">Enviroment</span>
                    </div>
                    <div class="absolute hidden w-5 h-full end-0 md:block">
                        <svg fill="none" preserveAspectRatio="none" viewBox="0 0 22 80" class="w-full h-full text-slate-500">
                            <path d="M0 -2L20 40L0 82" stroke-linejoin="round" stroke="currentcolor" vector-effect="non-scaling-stroke"></path>
                        </svg>
                    </div>
                </li>
                <li class="flex w-full pl-6 border-b border-slate-500">
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
                        <span class="flex-1 text-sm font-medium">Account</span>
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
