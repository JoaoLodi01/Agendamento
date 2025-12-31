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
            'customer_id' => 'nullable|exists:users,id',
            'attendant_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'day_of_week' => 'nullable',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'break_start' => 'nullable',
            'break_end' => 'nullable',
            'service_interval' => 'nullable|integer',
            'scheduled_at' => 'required|date|after_or_equal:today',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|in:scheduled, confirmed, canceled, done',
        ];
    }
}
