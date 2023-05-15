<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BonusEditRequest extends FormRequest
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
            'bonus_name' => 'required',
            'coins' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'bonus_name.required' => 'Your Bonus Name is required',
            'coins.required' => 'Your Bonus Coin is required',
        ];
    }
}
