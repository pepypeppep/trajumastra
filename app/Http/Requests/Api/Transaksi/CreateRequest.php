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
            'transaction_type' => 'required|integer',
            'master_jenis_ikan_id' => 'required|integer|exists:master_jenis_ikans,id',
            'number_of_fish' => 'required|integer',
            'abk_name' => 'nullable|string',
            'amount' => 'required|integer',
        ];
    }
}
