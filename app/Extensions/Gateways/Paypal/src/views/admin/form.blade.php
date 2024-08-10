<div
    x-data="{
        data: {
            email: '',
            active: '1'
        },

        errors: {
            email: null,
        },
    }"
    x-modelable="data"
    x-on:validation-errors.window="errors = $event.detail"
>
    <x-card>
        <x-card.content>
            <x-form.group>
                <x-form.label for="email">Email:</x-form.label>
                <x-form.input x-model="form.data.email" x-on:input="errors.email = null" id="email"/>
                <x-form.error x-show="errors.email" x-text="errors.email" for="email"/>
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
