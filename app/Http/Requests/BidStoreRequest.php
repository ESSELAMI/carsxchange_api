<?php

namespace App\Http\Requests;

use App\Models\Car;
use GuzzleHttp\Psr7\Response;
use Illuminate\Auth\Access\Response as AccessResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class BidStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): AccessResponse
    {
        return Gate::inspect('create', [Bid::class, $this->route('car')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
      
        return [
            'price' => 'required|numeric',
        ];
    }
}
