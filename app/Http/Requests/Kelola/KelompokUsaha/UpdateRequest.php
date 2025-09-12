<?php

namespace App\Http\Requests\Kelola\KelompokUsaha;

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
            'kelompok_binaan_id' => 'required|exists:kelompok_binaans,id',
            'bentuk_usaha_id' => 'required|exists:master_bentuk_usahas,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'leader' => 'required|string|max:255',
            'members' => 'required|integer',
            'nib' => 'required|string|max:255',
            'income_range' => 'required|string|max:255',
        ];
    }
}
