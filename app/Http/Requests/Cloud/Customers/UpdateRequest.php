<?php

namespace App\Http\Requests\Cloud\Customers;

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
            'vehicle_type_id' => 'required',
            'name' => 'required|string|max:50',
            'car_number' => 'required|string|max:30',
            'type' => 'required|string|max:10',
            'email' => 'nullable|email|max:30',
            'phone' => 'nullable|max:20',
            'address' => 'nullable|max:100',
            'card_number' => 'nullable|max:30',
            'debit_liter' => 'nullable',
            'debit_amount' => 'nullable',
        ];
    }
}
