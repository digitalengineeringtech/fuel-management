<?php

namespace App\Http\Requests\Cloud\Shops;

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
            'name' => ['required', 'string', 'max:30'],
            'code' => ['string'],
            'image' => ['nullable', 'image', 'max:4096', 'mimes:jpg,jpeg,png'],
            'address' => ['required', 'string', 'max:100'],
            'importer_name' => ['nullable', 'string'],
            'importer_company' => ['nullable', 'string'],
        ];
    }
}
