<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'full_name' => 'required|string',
            'cpf' => 'nullable',
            'cnpj' => 'nullable',
            'phone' => 'nullable',
            'email' => 'nullable',
            'date_birth' => 'nullable',
            'sex' => 'nullable',
            'cep' => 'nullable',
            'uf' => 'nullable',
            'municipality' => 'nullable',
            'address' => 'nullable',
            'number' => 'nullable',
            'district' => 'nullable',
            'complement' => 'nullable',
            'photo' => 'nullable',
            'active' => 'nullable',
        ];
    }
}
