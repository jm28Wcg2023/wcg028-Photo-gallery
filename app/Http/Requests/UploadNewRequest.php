<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadNewRequest extends FormRequest
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
        $rules = [
            'images' => 'required',
            'images.*' => 'mimes:jpeg,png,jpg|max:2048',
            'titles.*' => 'required',
            'descriptions.*' => 'required',
            'coins.*' => 'required|numeric',
        ];
        return $rules;
    }
}
