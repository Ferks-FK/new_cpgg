<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePterodactylSettingsRequest extends FormRequest
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
            'pterodactyl_api_url' => 'required|url',
            'pterodactyl_api_user_key' => 'required|string',
            'pterodactyl_api_admin_key' => 'required|string',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'pterodactyl_api_url' => rtrim($this->input('pterodactyl_api_url'), '/'),
        ]);
    }
}
