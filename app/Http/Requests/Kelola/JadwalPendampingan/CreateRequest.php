<?php

namespace App\Http\Requests\Kelola\JadwalPendampingan;

use Illuminate\Validation\Rules\Enum;
use App\Enums\JenisPenyuluhanStatusEnum;
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
            'name' => 'required|string|max:255',
            'periode' => 'required|string',
            'description' => 'required|string',
            'jenis_penyuluhan_id' => 'required|exists:master_jenis_penyuluhans,id',
            'kategori_id' => 'required|exists:master_kategoris,id',
            'penyuluh_id' => 'required|array',
            'penyuluh_id.*' => 'exists:penyuluhs,id',
            'theme' => 'required|string',
            'quota' => 'required|numeric',
            'status' => ['required', new Enum(JenisPenyuluhanStatusEnum::class)],
            'attachment' => 'nullable|file|max:10240', // Maksimal 10MB
        ];
    }
}
