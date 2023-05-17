<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class changePasswordRequest extends FormRequest
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
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
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
            'current-password.required' => 'Your current-password is required',
            'new-password.required' => 'Here add new-password',
            'new-password.min' =>'Your new-password Should be Minimum of 8 Character',
            'new-password.confirmed' => 'your new-password not match to confirm-password'
        ];
    }

}
