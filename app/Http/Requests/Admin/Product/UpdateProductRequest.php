<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'memory' => 'required|integer',
            'disk' => 'required|integer',
            'cpu' => 'required|integer',
            'swap' => 'required|integer',
            'io' => 'required|integer',
            'databases' => 'required|integer',
            'backups' => 'required|integer',
            'allocations' => 'required|integer',
            'minimum_credits' => 'required|numeric',
            'active' => 'required|boolean',
            'nodes' => 'array',
            'eggs' => 'array'
        ];
    }
}
