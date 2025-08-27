<?php

namespace App\Http\Requests\Kelola\PelakuUsaha;

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
            'kalurahan_id' => 'required|exists:kalurahans,id',
            'kelompok_binaan_id' => 'exists:kelompok_binaans,id',
            'bentuk_usaha_id' => 'required|exists:master_bentuk_usahas,id',
            'jenis_usaha_id' => 'required|exists:master_jenis_usahas,id',
            'user_id' => 'required|exists:users,id',
            'secretariat_address' => 'required|string',
            'npwp' => 'required|numeric',
            'siup' => 'required|numeric',
            'income_range' => 'required|string',
        ];
    }
}
