<?php

namespace App\Http\Requests\Server;

use Illuminate\Foundation\Http\FormRequest;

class CreateServerRequest extends FormRequest
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
        $rules =  [
            'name' => 'required|string',
            'egg_id' => 'required|integer',
            'location_id' => 'required|integer',
            'product_id' => 'required|exists:products,id',
            'egg_variables' => 'nullable|array'
        ];

        if (!empty($this->egg_variables)) {
            foreach ($this->egg_variables as $key => $egg_variable) {
                $rules["egg_variables.$key.id"] = 'required|string';
                $rules["egg_variables.$key.label"] = 'required|string';
                $rules["egg_variables.$key.type"] = 'required|string';
                $rules["egg_variables.$key.value"] = $egg_variable['rules'];
            }
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = [];

        if (!empty($this->egg_variables)) {
            foreach ($this->egg_variables as $key => $egg_variable) {
                $attributes["egg_variables.$key.value"] = $egg_variable['label'];
            }
        }

        return $attributes;
    }
}
