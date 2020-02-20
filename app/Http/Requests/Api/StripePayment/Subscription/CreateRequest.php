<?php

namespace App\Http\Requests\Api\StripePayment\Subscription;

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
