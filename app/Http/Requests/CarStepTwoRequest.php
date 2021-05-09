<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarStepTwoRequest extends FormRequest
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
            'price' => [
                'bail',
                'required',
                'regex:/^([0-9]+)$/',
            ],
            'discount' => [
                'nullable',
                'regex:/^([0-9]+)$/',
            ],
            'limited_km' => [
                'nullable',
                'regex:/^([0-9]+)$/',
            ],
            'limit_pass_fee' => [
                'nullable',
                'regex:/^([0-9]+)$/',
            ],
            'description' => [
                'nullable',
                'max:255',
            ],
        ];
    }
}
