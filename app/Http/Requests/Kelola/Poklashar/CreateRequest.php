<?php

namespace App\Http\Requests\Kelola\Poklashar;

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
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'leader' => 'required|string|max:255',
            'members' => 'required|integer',
            'market' => 'required|string|max:255',
            'jenis_usaha_id' => 'required|array',
            'jenis_usaha_id.*' => 'integer|exists:master_jenis_usahas,id',
        ];
    }
}
