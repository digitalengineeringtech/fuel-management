<?php

namespace App\Http\Requests\Cloud\Members;

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
            'customer_id' => 'required',
            'type' => 'nullable',
            'claim_point' => 'nullable',
            'redeem_point' => 'nullable',
            'total_point' => 'nullable',
            'expiry_date' => 'nullable',
        ];
    }
}
