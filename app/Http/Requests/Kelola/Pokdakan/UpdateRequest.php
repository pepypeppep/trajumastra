<?php

namespace App\Http\Requests\Kelola\Pokdakan;

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
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'leader' => 'required|string|max:255',
            'members' => 'required|integer',
            'jenis_ikan_id' => 'required|array',
            'jenis_ikan_id.*' => 'integer|exists:master_jenis_ikans,id',
            'jenis_usaha_id' => 'required|array',
            'jenis_usaha_id.*' => 'integer|exists:master_jenis_usahas,id',
            'jenis_kolam_id' => 'required|array',
            'jenis_kolam_id.*' => 'integer|exists:master_jenis_asets,id',
        ];
    }
}
