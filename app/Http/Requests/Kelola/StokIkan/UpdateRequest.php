<?php

namespace App\Http\Requests\Kelola\StokIkan;

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
            'uptd_id' => 'required|exists:uptds,id',
            'jenis_ikan_id' => 'required|exists:master_jenis_ikans,id',
            'stock' => 'required|integer',
        ];
    }
}
