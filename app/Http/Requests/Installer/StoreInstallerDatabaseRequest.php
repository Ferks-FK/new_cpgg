<?php

namespace App\Http\Requests\Installer;

use Illuminate\Foundation\Http\FormRequest;

class StoreInstallerDatabaseRequest extends FormRequest
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
            'database_name' => 'required|string',
            'database_host' => 'required|string',
            'database_port' => 'required|string',
            'database_user' => 'required|string',
            'database_password' => 'nullable|string',
        ];
    }
}
