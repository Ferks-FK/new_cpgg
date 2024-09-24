@extends('layouts.installer')

@section('content')
    <div x-init="setEnviromentData({{ json_encode($enviroments) }})" class="flex flex-col gap-5">
        <x-form id="enviroment" x-on:submit.prevent="handleEnviroment()">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <x-form.group>
                    <x-form.label for="appName">App Name</x-form.label>
                    <x-form.input x-model="form.enviroment.data.app_name" x-on:input="form.enviroment.errors.app_name = null" id="appName"/>
                    <x-form.error x-show="form.enviroment.errors.app_name" x-text="form.enviroment.errors.app_name"/>
                </x-form.group>
                <x-form.group>
                    <x-form.label for="appUrl">App URL</x-form.label>
                    <x-form.input x-model="form.enviroment.data.app_url" x-on:input="form.enviroment.errors.app_url = null" id="appUrl"/>
                    <x-form.error x-show="form.enviroment.errors.app_url" x-text="form.enviroment.errors.app_url"/>
                </x-form.group>
            </div>
            <div x-on:switch-change.window="form.enviroment.data.panel = $event.detail ? 'pterodactyl' : 'pelican'" class="flex flex-col gap-5">
                <x-switch
                    name="panel"
                    label="Pterodactyl or Pelican?"
                    x-bind:default="form.enviroment.data.panel === 'pterodactyl'"
                />
                <template x-if="form.enviroment.data.panel === 'pterodactyl'">
                    <div class="flex flex-col gap-5">
                        <x-form.group>
                            <x-form.label for="pterodactylURL">Pterodactyl URL</x-form.label>
                            <x-form.input x-model="form.enviroment.data.panel_url" x-on:input="form.enviroment.errors.panel_url = null" id="pterodactylURL"/>
                            <x-form.error x-show="form.enviroment.errors.panel_url" x-text="form.enviroment.errors.panel_url"/>
                        </x-form.group>
                        <x-form.group>
                            <x-form.label for="pterodactylAPI">Pterodactyl API Key</x-form.label>
                            <x-form.input x-model="form.enviroment.data.panel_api_key" x-on:input="form.enviroment.errors.panel_api_key = null" id="pterodactylAPI"/>
                            <x-form.error x-show="form.enviroment.errors.panel_api_key" x-text="form.enviroment.errors.panel_api_key"/>
                        </x-form.group>
                    </div>
                </template>
                <template x-if="form.enviroment.data.panel === 'pelican'">
                    <div class="flex flex-col gap-5">
                        <x-form.group>
                            <x-form.label for="pelicanURL">Pelican URL</x-form.label>
                            <x-form.input x-model="form.enviroment.data.panel_url" x-on:input="form.enviroment.errors.panel_url = null" id="pelicanURL"/>
                            <x-form.error x-show="form.enviroment.errors.panel_url" x-text="form.enviroment.errors.panel_url"/>
                        </x-form.group>
                        <x-form.group>
                            <x-form.label for="pelicanAPI">Pelican API Key</x-form.label>
                            <x-form.input x-model="form.enviroment.data.panel_api_key" x-on:input="form.enviroment.errors.panel_api_key = null" id="pelicanAPI"/>
                            <x-form.error x-show="form.enviroment.errors.panel_api_key" x-text="form.enviroment.errors.panel_api_key"/>
                        </x-form.group>
                    </div>
                </template>
            </div>
        </x-form>
        <div class="flex justify-between w-full gap-5">
            <x-button as="link" href="{{ route('install.database') }}">
                Back
            </x-button>
            <x-button type="submit" form="enviroment" class="w-fit">
                <span x-show="!form.enviroment.loading">
                    Next
                </span>
                <span x-cloak x-show="form.enviroment.loading">
                    <x-icon.loading/>
                </span>
            </x-button>
        </div>
    </div>
@endsection
