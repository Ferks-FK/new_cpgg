<?php

namespace App\Http\Requests\Installer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreInstallerEnviromentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'app_name' => 'required|string',
            'app_url' => 'required|url',
            'panel' => 'required|in:pterodactyl,pelican',
            'panel_url' => 'required|url',
            'panel_api_key' => 'required|string',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'panel_url' => rtrim($this->input('panel_url'), '/'),
        ]);
    }

    /**
     * Configure the validator instance.
     */
    protected function withValidator(Validator $validator)
    {
        // Case for dummy people.
        $validator->after(function ($validator) {
            if (str_contains($this->input('panel_url'), 'example')) {
                $validator->errors()->add('panel_url', 'The panel URL must not contain "example".');
            }
        });
    }
}
