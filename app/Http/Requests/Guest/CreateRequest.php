<?php

namespace App\Http\Requests\Guest;

use App\Rules\ReCaptcha;
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
            'jenisUsaha' => 'required|exists:master_jenis_usahas,id',
            'bentukUsaha' => 'required|exists:master_bentuk_usahas,id',
            'kelompokBinaan' => 'required|exists:kelompok_binaans,id',
            'npwp' => 'required|numeric|digits:15',
            'siup' => 'required|string|max:255',
            'rangePenghasilan' => 'required|exists:master_penghasilans,id',
            'phone' => 'required|numeric|digits:12',
            'email' => 'required|email',
            'kalurahan' => 'required|exists:kalurahans,id',
            'alamat' => 'required|string|max:255',
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ];
    }
}
