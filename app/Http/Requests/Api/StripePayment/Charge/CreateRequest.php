<?php

namespace App\Http\Requests\Api\StripePayment\Charge;

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
                'required',
                'string',
            ],
        ];
    }
}
