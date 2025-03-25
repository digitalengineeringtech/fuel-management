<?php

namespace App\Http\Requests\Local\Fuelins;

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
            'tank_id' => ['required'],
            'station_id' => ['required'],
            'fuel_type_id' => ['required'],
            'code' => ['required', 'numeric'],
            'terminal_name' => ['required', 'string', 'max:50'],
            'driver_name' => ['required', 'string', 'max:50'],
            'bowser_no' => ['required', 'string', 'max:20'],
            'tank_capacity' => ['required', 'numeric'],
            'opening_balance' => ['nullable', 'numeric'],
            'closing_balance' => ['nullable', 'numeric'],
            'current_balance' => ['nullable', 'numeric'],
            'send_balance' => ['nullable', 'numeric'],
            'receive_balance' => ['nullable', 'numeric'],
            'receive_date' => ['nullable'],
        ];
    }
}
