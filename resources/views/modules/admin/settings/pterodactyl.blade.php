@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="#">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item icon="icon.settings">Pterodactyl Settings</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module x-data="settings()" x-init="setSettingsData({{ json_encode($settings) }})">
        <x-module.header>
            <x-module.title>Pterodactyl Settings</x-module.title>
        </x-module.header>
        <x-card>
            <x-card.content>
                <x-form x-on:submit.prevent="updateSettings('settings/pterodactyl')">
                    <x-form.group>
                        <x-form.label for="pterodactylUrl">Pterodactyl URL:</x-form.label>
                        <x-form.input x-model="form.data.pterodactyl_api_url" id="pterodactylUrl"/>
                        <x-form.error x-show="form.errors.pterodactyl_api_url" x-text="form.errors.pterodactyl_api_url"/>
                    </x-form.group>
                    <x-form.group>
                        <x-form.label for="pterodactylApiKey">Pterodactyl User Key:</x-form.label>
                        <x-form.input x-model="form.data.pterodactyl_api_key" id="pterodactylApiKey"/>
                        <x-form.error x-show="form.errors.pterodactyl_api_key" x-text="form.errors.pterodactyl_api_key"/>
                    </x-form.group>
                    <x-form.footer>
                        <x-button type="submit">
                            <span x-show="!form.loading">
                                Save
                            </span>
                            <span x-show="form.loading">
                                <x-icon.loading/>
                            </span>
                        </x-button>
                    </x-form.footer>
                </x-form>
            </x-card.content>
        </x-card>
    </x-module>
@endsection
