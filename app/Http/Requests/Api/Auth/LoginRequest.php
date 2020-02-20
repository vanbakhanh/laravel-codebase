<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\AbstractRequest;

class LoginRequest extends AbstractRequest
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
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'password' => [
                'required',
                'max:255',
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
