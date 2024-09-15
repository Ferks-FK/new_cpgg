@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="#">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item icon="icon.settings">Global Settings</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module x-data="settings()" x-init="setSettingsData({{ json_encode($settings) }})">
        <x-module.header>
            <x-module.title>Global Settings</x-module.title>
        </x-module.header>
        <x-card>
            <x-card.content>
                <x-form x-on:submit.prevent="updateSettings('settings/global')">
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <x-form.group>
                            <x-form.label for="siteName">Site Name:</x-form.label>
                            <x-form.input x-model="form.data.site_name" id="siteName"/>
                            <x-form.error x-show="form.errors.site_name" x-text="form.errors.site_name"/>
                        </x-form.group>
                        <x-form.group>
                            <x-form.label for="siteUrl">Site URL:</x-form.label>
                            <x-form.input x-model="form.data.site_url" id="siteUrl"/>
                            <x-form.error x-show="form.errors.site_url" x-text="form.errors.site_url"/>
                        </x-form.group>
                    </div>
                    <x-form.group>
                        <x-form.label for="creditsDisplay">Credits Display:</x-form.label>
                        <x-form.input x-model="form.data.credits_display" id="creditsDisplay"/>
                        <x-form.error x-show="form.errors.credits_display" x-text="form.errors.credits_display"/>
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
