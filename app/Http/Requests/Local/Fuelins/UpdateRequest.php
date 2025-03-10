<?php

namespace App\Http\Requests\Local\Fuelins;

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
            'station_id' => ['required', 'exists:dispensers,id'],
            'fuel_type_id' => ['required', 'exists:fuel_types,id'],
            'code' => ['required', 'numeric'],
            'tank_no' => ['required', 'numeric'],
            'terminal_name' => ['required', 'string', 'max:50'],
            'driver_name' => ['required', 'string', 'max:50'],
            'bowser_no' => ['required', 'string', 'max:20'],
            'tank_capacity' => ['required', 'float'],
            'opening_balance' => ['nullable', 'float'],
            'current_balance' => ['nullable', 'float'],
            'send_balance' => ['nullable', 'float'],
            'receive_balance' => ['nullable', 'float'],
            'receive_date' => ['nullable'],
        ];
    }
}
