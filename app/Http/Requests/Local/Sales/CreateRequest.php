<?php

namespace App\Http\Requests\Local\Sales;

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
            'station_id' => ['required'],
            'dispenser_id' => ['required'],
            'nozzle_id' => ['required'],
            'fuel_type_id' => ['required'],
            'payment_id' => ['nullable'],
            'discount_id' => ['nullable'],
            'customer_id' => ['nullable'],
            'vehicle_type_id' => ['nullable'],
            'tank_id' => ['required'],
            'voucher_no' => ['nullable', 'string'],
            'cashier_code' => ['required', 'string'],
            'car_no' => ['nullable', 'string'],
            'device' => ['string'],
            'tank_balance' => ['nullable'],
            'totalizer_liter' => ['nullable'],
            'totalizer_amount' => ['nullable'],
            'device_totalizer_liter' => ['nullable'],
            'device_totalizer_amount' => ['nullable'],
            'sale_liter' => ['nullable'],
            'sale_price' => ['nullable'],
            'total_price' => ['nullable'],
            'is_preset' => ['nullable', 'boolean'],
            'preset_amount' => ['nullable'],
            'daily_report_date' => ['nullable'],
        ];
    }
}
