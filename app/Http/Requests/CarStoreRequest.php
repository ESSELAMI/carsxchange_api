<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'brand' => 'required',
            'model' => 'required',
            'body_type' => 'required',
            'fuel_type' => 'required',
            'seats' => 'required|integer',
            'year' => 'required',
            'picture' => 'required',
            'mileage' => 'required',
        ];
    }
}
