<?php

namespace App\Http\Requests\Station;

use Illuminate\Foundation\Http\FormRequest;

class SensorsRequest extends FormRequest
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
            'type' => ['required', 'string', 'max:15'],
            'partnumber' => ['string', 'max:10'],
            'description' => ['string', 'max:32'],
            'stations_id' => 'required'
        ];
    }
}
