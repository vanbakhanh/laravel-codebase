<?php

namespace App\Http\Requests\Api\StripePayment\Charge;

use Illuminate\Foundation\Http\FormRequest;

class CreateWithTokenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'number' => [
                'required',
                'string',
            ],
            'exp_month' => [
                'required',
                'integer',
            ],
            'exp_year' => [
                'required',
                'integer',
            ],
            'cvc' => [
                'required',
                'string',
            ],
            'name' => [
                'string',
                'nullable',
            ],
            'customer' => [
                'sometimes',
                'required',
                'string',
            ],
            'amount' => [
                'required',
                'integer',
                'min:50',
            ],
            'description' => [
                'string',
            ],
            'source' => [
                'sometimes',
                'required',
                'string',
            ],
            'currency' => [
                'string',
            ],
        ];
    }
}
