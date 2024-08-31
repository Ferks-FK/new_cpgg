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
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <x-form.group>
                            <x-form.label for="pterodactylUserKey">Pterodactyl User Key:</x-form.label>
                            <x-form.input x-model="form.data.pterodactyl_api_user_key" id="pterodactylUserKey"/>
                            <x-form.error x-show="form.errors.pterodactyl_api_user_key" x-text="form.errors.pterodactyl_api_user_key"/>
                        </x-form.group>
                        <x-form.group>
                            <x-form.label for="pterodactylAdminKey">Pterodactyl Admin Key:</x-form.label>
                            <x-form.input x-model="form.data.pterodactyl_api_admin_key" id="pterodactylAdminKey"/>
                            <x-form.error x-show="form.errors.pterodactyl_api_admin_key" x-text="form.errors.pterodactyl_api_admin_key"/>
                        </x-form.group>
                    </div>
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
