@extends('layouts.installer')

@section('content')
    <div x-init="setRequirementsData({{ json_encode($requirements) }})" class="flex flex-col gap-5">
        <div class="flex flex-col w-full gap-5">
            <div class="border rounded-lg border-slate-500">
                <div class="p-4">
                    <p>PHP Version: <strong>8.2 or newer</strong></p>
                    <p class="text-sm">Current: <strong x-text="requirements.php.current"></strong></p>
                </div>
                <div class="w-full p-4 border-t border-slate-500">
                    <span
                        class="text-sm"
                        x-bind:class="{
                            'text-emerald-400': requirements.php.isSupported,
                            'text-red-500': !requirements.php.isSupported
                        }"
                        x-text="requirements.php.isSupported
                            ? 'Your PHP Version is supported.'
                            : 'Your PHP Version is not supported.'
                        "
                    >
                    </span>
                </div>
            </div>
            <div class="border rounded-lg border-slate-500">
                <div class="p-4">
                    <p>PHP Extensions</p>
                    <p class="text-sm">
                        <strong>Installed:</strong>
                        <span x-text="requirements.php.extensions.installed || 'None'"></span>
                    </p>
                </div>
                <div class="w-full p-4 border-t border-slate-500">
                    <template x-if="requirements.php.extensions.missing">
                        <p class="text-sm">
                            <strong>Missing:</strong>
                            <span class="text-red-500" x-text="requirements.php.extensions.missing"></span>
                        </p>
                    </template>
                    <template x-if="!requirements.php.extensions.missing">
                        <span class="text-sm text-emerald-400">All required extensions are installed.</span>
                    </template>
                </div>
            </div>
            <div class="border rounded-lg border-slate-500">
                <div class="p-4">
                    <p>Folder Permissions</p>
                    <span class="text-sm" x-text="requirements.directories.folders"></span>
                </div>
                <div class="w-full p-4 border-t border-slate-500">
                    <template x-if="requirements.directories.allCorrect">
                        <span class="text-sm text-emerald-400">All folders are writable.</span>
                    </template>
                    <template x-if="!requirements.directories.allCorrect">
                        <span class="text-sm text-red-500">Some folders are not writable. Please check the permissions.</span>
                    </template>
                </div>
            </div>
        </div>
        <div class="flex justify-end w-full">
            <template x-if="requirements.php.isSupported && !requirements.php.extensions.missing && requirements.directories.allCorrect">
                <x-button as="link" href="{{ route('install.database') }}" class="w-fit">
                    Next
                </x-button>
            </template>
            <template x-if="!requirements.php.isSupported || requirements.php.extensions.missing || !requirements.directories.allCorrect">
                <x-button disabled>
                    Next
                </x-button>
            </template>
        </div>
    </div>
@endsection
