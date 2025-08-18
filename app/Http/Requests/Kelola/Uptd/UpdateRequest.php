<?php

namespace App\Http\Requests\Kelola\Uptd;

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
            'dusun' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'required|string|max:255',
            'longitude' => 'required|string|max:255',
            'jenis_ikan_id' => 'required|array',
            'jenis_ikan_id.*' => 'integer|exists:master_jenis_ikans,id',
            'type' => 'nullable|integer',
            'status' => 'nullable|integer',
        ];
    }
}
