<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CarRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'license_plates' => [
                'required',
                'max:20',
                'unique:cars',
            ],
            'trademark' => [
                'required',
            ],
            'vehicle' => [
                'required',
            ],
            'actions' => [
                'required',
            ],
            'type_of_fuel' => [
                'required',
            ],
            'year_of_product' => [
                'required',
            ],
            'seats' => [
                'required',
            ],
            'fuel_consumption' => [
                'required',
            ],
        ];
    }
}
