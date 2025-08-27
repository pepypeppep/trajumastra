<?php

namespace App\Http\Requests\Kelola\Penyuluh;

use Illuminate\Validation\Rule;
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
    public function rules()
    {
        $id = $this->route('penyuluh'); // ambil id dari route parameter

        return [
            'user_id' => [
                'required',
                Rule::unique('penyuluhs', 'user_id')->ignore($id),
            ],
        ];
    }

    public function messages()
    {
        return [
            'user_id.unique' => 'Penyuluh sudah digunakan.',
        ];
    }
}
