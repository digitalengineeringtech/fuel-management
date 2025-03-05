<?php

namespace App\Http\Requests\Local\Nozzles;

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
            'dispenser_id' => ['required'],
            'stock_price_id' => ['required'],
            'nozzle_no' => ['required', 'numeric'],
            'auto_approve' => ['boolean'],
            'semi_approve' => ['boolean'],
            'cashier_approve' => ['boolean'],
        ];
    }
}
