<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CarUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $car = $this->route('car');

        return $car && $this->user()->can('update', $car);
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
