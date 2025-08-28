<?php

namespace App\Http\Requests\Master\Materi;

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
            'title' => 'required|string|max:255',
            'tag' => 'required|array',
            'tag.*' => 'string|max:100',
            'description' => 'required|string',
            'attachment' => 'required|mimes:pdf,jpg,jpeg,png|max:10000',
            'attachment_type' => 'nullable|integer',
        ];
    }
}
