<?php

namespace App\Http\Requests\Cloud\Stations;

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
            'shop_id' => 'required',
            'name' => 'required|string|max:50',
            'station_no' => 'required|string|max:20|unique:stations',
            'image' => 'nullable|image|max:4096',
            'phone_one' => 'required|string|max:20',
            'phone_two' => 'nullable|string|max:20',
            'address' => 'required|string|max:50',
            'opening_date' => 'required|date',
            'subscribe_year' => 'required|integer',
            'expiry_date' => 'required|date',
            'opening_hour' => 'required|string|max:20',
            'closing_hour' => 'required|string|max:20',
            'station_database' => 'nullable|string|max:255',
        ];
    }
}
