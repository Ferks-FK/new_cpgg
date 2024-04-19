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
        return [
            'name' => 'required|string',
            'egg_id' => 'required|integer',
            'node_id' => 'required|integer',
            'product_id' => 'required|exists:products,id',
        ];
    }
}
