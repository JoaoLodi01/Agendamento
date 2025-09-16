<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendaRequest extends FormRequest
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
            'customer_id' => 'nullable',
            'attendant_id' => 'required',
            'service_id' => 'required',
            'day_of_week' => 'nullable',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'break_start' => 'nullable',
            'break_end' => 'nullable',
            'service_interval' => 'nullable|integer',
            'scheduled_at' => 'nullable|date',
            'price' => 'nullable|numeric',
            'status' => 'nullable|string',
            'active' => 'nullable|boolean',
        ];
    }
}
