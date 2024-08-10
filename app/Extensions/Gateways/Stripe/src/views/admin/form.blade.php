<div
    x-data="{
        data: {
            public_key: '',
            secret_key: '',
            webhook_secret: '',
            active: '1'
        },

        errors: {
            public_key: null,
            secret_key: null,
            webhook_secret: null,
        },
    }"
    x-modelable="data"
    x-on:validation-errors.window="errors = $event.detail"
>
    <x-card class="">
        <x-card.content>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <x-form.group>
                    <x-form.label for="public_key">Public Key:</x-form.label>
                    <x-form.input x-model="form.data.public_key" x-on:input="errors.public_key = null" id="public_key"/>
                    <x-form.error x-show="errors.public_key" x-text="errors.public_key"/>
                </x-form.group>
                <x-form.group>
                    <x-form.label for="secret_key">Secret Key:</x-form.label>
                    <x-form.input x-model="form.data.secret_key" x-on:input="errors.secret_key = null" id="secret_key"/>
                    <x-form.error x-show="errors.secret_key" x-text="errors.secret_key"/>
                </x-form.group>
            </div>
            <x-form.group>
                <x-form.label for="webhook_secret">Webhook Secret:</x-form.label>
                <x-form.input x-model="form.data.webhook_secret" x-on:input="errors.webhook_secret = null" id="webhook_secret"/>
                <x-form.error x-show="errors.webhook_secret" x-text="errors.webhook_secret"/>
            </x-form.group>
            <x-form.group>
                <x-form.label for="active">Active:</x-form.label>
                <x-select x-model="form.data.active" id="active">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </x-select>
            </x-form.group>
        </x-card.content>
    </x-card>
</div>
