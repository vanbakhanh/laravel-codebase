<?php

namespace App\Http\Requests\Web\Role;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'unique:roles',
            ],
            'guard_name' => [
                'required',
                'string',
            ],
            'permissions' => [
                'array',
            ],
        ];
    }
}
