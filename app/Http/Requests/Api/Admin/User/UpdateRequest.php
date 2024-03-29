<?php

namespace App\Http\Requests\Api\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'profile.first_name' => [
                'required',
                'string',
                'max:255',
            ],
            'profile.last_name' => [
                'required',
                'string',
                'max:255',
            ],
            'status' => [
                'in:' .  config('model.user.status.inactive') . ',' .  config('model.user.status.active')
            ]
        ];
    }
}
