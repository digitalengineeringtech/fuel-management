<?php

namespace App\Http\Requests\Local\Dispensers;

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
            'device_ip' => ['required'],
            'server_ip' => ['required'],
            'server_port' => ['required'],
            'firmware_version' => ['nullable'],
            'boot_count' => ['nullable'],
            'retry_count' => ['nullable'],
            'debug_bit' => ['nullable'],
            'password' => ['nullable'],
            'wifi_ssid' => ['required'],
            'wifi_password' => ['required'],
        ];
    }
}
