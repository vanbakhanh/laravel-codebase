<?php

namespace App\Http\Requests\Api\StripePayment\Subscription;

use Illuminate\Foundation\Http\FormRequest;

class CreateWithPaymentMethodRequest extends FormRequest
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
            'subscription' => [
                'required',
                'in:main,primary',
                'string',
            ],
            'plan_id' => [
                'required',
                'string',
            ],
            'payment_method' => [
                'required',
                'string',
            ],
        ];
    }
}
