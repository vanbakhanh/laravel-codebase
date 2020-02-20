<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\AbstractRequest;

class LoginSocialRequest extends AbstractRequest
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
            'provider' => [
                'required',
                'string',
                'max:10',
            ],
            'token' => [
                'required',
                'string',
            ],
            'client_id' => [
                'required',
            ],
            'client_secret' => [
                'required',
            ],
        ];
    }
}
