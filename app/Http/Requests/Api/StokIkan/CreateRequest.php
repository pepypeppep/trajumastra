<?php

namespace App\Http\Requests\Api\StokIkan;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'stock' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'stock.required' => 'Stock harus diisi',
            'stock.integer' => 'Stock harus berupa integer',
            'stock.min' => 'Stock minimal 1',
        ];
    }
}
