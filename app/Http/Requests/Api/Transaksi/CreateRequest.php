<?php

namespace App\Http\Requests\Api\Transaksi;

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
            'transactions' => 'required|array',
            'transactions.*.master_jenis_ikan_id' => 'required|integer|exists:master_jenis_ikans,id',
            'transactions.*.quantity' => 'required|integer|min:1'
        ];
    }

    public function messages(): array
    {
        return [
            'transactions.required' => 'Data transaksi harus diisi',
            'transactions.array' => 'Format transaksi tidak valid',
            'transactions.*.master_jenis_ikan_id.required' => 'ID jenis ikan harus diisi',
            'transactions.*.master_jenis_ikan_id.exists' => 'Jenis ikan tidak valid',
            'transactions.*.quantity.required' => 'Quantity harus diisi',
            'transactions.*.quantity.integer' => 'Quantity harus berupa angka',
            'transactions.*.quantity.min' => 'Quantity minimal 1'
        ];
    }
}
