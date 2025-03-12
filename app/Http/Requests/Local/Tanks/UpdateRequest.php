<?php

namespace App\Http\Requests\Local\Tanks;

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
            'station_id' => ['required'],
            'oil_type' => ['required', 'string'],
            'state_info' => ['nullable', 'string'],
            'volume' => ['nullable', 'float'],
            'oil_ratio' => ['nullable', 'float'],
            'level' => ['nullable', 'number'],
            'temperature' => ['nullable', 'number'],
            'weight' => ['required', 'float'],
            'water_ratio' => ['required', 'float'],
            'avaliable_oil_weight' => ['required', 'float']
        ];
    }
}
