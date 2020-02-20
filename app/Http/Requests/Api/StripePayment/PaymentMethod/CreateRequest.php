<?php

namespace App\Http\Requests\Api\StripePayment\PaymentMethod;

use App\Http\Requests\Api\AbstractRequest;

class CreateRequest extends AbstractRequest
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
            'billing_details' => [
                'array',
            ],
            'billing_details.address' => [
                'array',
            ],
        ];
    }
}
