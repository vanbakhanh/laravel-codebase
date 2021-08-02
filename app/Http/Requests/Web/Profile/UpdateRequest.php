<?php

namespace App\Http\Requests\Web\Profile;

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
            'first_name' => [
                'required',
                'string',
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'max:255',
            ],
            'avatar' => [
                'sometimes',
                'required',
                'image',
                'mimes:jpeg,png,jpg',
                'max:1024',
            ],
            'address' => [
                'nullable',
                'string',
                'max:255',
            ],
            'phone' => [
                'nullable',
                'phone:US',
            ],
            'birthday' => [
                'nullable',
                'date',
                'before:today',
            ],
            'gender' => [
                'nullable',
                'integer',
                'in:0,1,2',
            ],
            'height_ft' => [
                'nullable',
                'integer',
                'in:0,1,2,3,4,5,6,7,8,9,10',
            ],
            'height_in' => [
                'nullable',
                'integer',
                'in:0,1,2,3,4,5,6,7,8,9,10',
            ],
            'weight' => [
                'nullable',
                'numeric',
            ],
            'street' => [
                'nullable',
                'string',
                'max:255',
            ],
            'city' => [
                'nullable',
                'string',
                'max:255',
            ],
            'state' => [
                'nullable',
                'string',
                'max:255',
            ],
            'zip_code' => [
                'nullable',
            ],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'avatar.file_extension' => "We don't accept your file type.",
        ];
    }
}
