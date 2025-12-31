<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicesRequest extends FormRequest
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
            'service' => 'required|string',
            'duration' => 'required|string',
            'price' => 'required|numeric',
            'categories_id' => 'nullable|numeric',
            'description' => 'nullable|string',
            'home_service' => 'nullable|boolean',
            'check_availability' => 'nullable|boolean'
        ];
    }
}
