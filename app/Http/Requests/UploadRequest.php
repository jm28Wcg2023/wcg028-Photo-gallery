<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            // 'name' => 'required',
            // 'description' => 'nullable',
            // 'coin' => 'required|numeric',
            // 'images' => 'required',
            // 'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'images' => 'required',
            'images.*' => 'mimes:jpeg,png,jpg|max:2048',
            'titles.*' => 'required',
            'descriptions.*' => 'required',
            'coins.*' => 'required|numeric',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'images.required' => 'The images field is required.',
            'images.*.mimes' => 'The images must be a file of type: jpeg, png, jpg.',
            'images.*.max' => 'The images may not be greater than 2048 kilobytes.',
            'titles.*.required' => 'The titles field is required.',
            'descriptions.*.required' => 'The descriptions field is required.',
            'coins.*.required' => 'The coins field is required.',
            'coins.*.numeric' => 'The coins field must be a number.',
        ];
    }
}
