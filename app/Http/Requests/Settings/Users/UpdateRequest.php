<?php

namespace App\Http\Requests\Settings\Users;

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
            'name' => 'required',
            'username' => 'required|alpha_dash|unique:users,username,' . $this->route('user'),
            'email' => 'required|email:rfc,dns|unique:users,email,' . $this->route('user'),
            'status' => 'required|in:0,1',
            'roles' => 'required',
        ];
    }
}
