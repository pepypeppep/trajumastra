<?php

namespace App\Http\Requests\Kelola\KelompokBinaan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'kalurahan_id' => 'required|exists:kalurahans,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'year' => 'required|numeric',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'npwp' => 'required|numeric',
            'sk' => 'required|string',
            'certificate_number' => 'required|string',
        ];
    }
}
