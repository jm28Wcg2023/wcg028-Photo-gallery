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
            'images' => 'required',
            'images.*' => 'mimes:jpeg,png,jpg|max:2048',
            'titles.*' => 'required',
            'descriptions.*' => 'required',
            'coins.*' => 'required|numeric',
        ];
        return $rules;
    }

    // public function messages()
    // {
    //     return [
    //         'images.required' => 'The images field is required.',
    //         'images.*.mimes' => 'The images must be a file of type: jpeg, png, jpg.',
    //         'images.*.max' => 'The images may not be greater than 2048 kilobytes.',
    //         'titles.*.required' => 'The titles field is required.',
    //         'descriptions.*.required' => 'The descriptions field is required.',
    //         'coins.*.required' => 'The coins field is required.',
    //         'coins.*.numeric' => 'The coins field must be a number.',
    //     ];
    // }
        public function attributes()
        {
            $attributes = [];

            foreach ($this->request->get('titles', []) as $key => $value) {
                $attributes['titles.' . $key] = 'Title for Image ' . ($key + 1);
            }

            foreach ($this->request->get('descriptions', []) as $key => $value) {
                $attributes['descriptions.' . $key] = 'Description for Image ' . ($key + 1);
            }

            foreach ($this->request->get('coins', []) as $key => $value) {
                $attributes['coins.' . $key] = 'Coin for Image ' . ($key + 1);
            }

            return $attributes;
        }

        public function messages()
        {
            $messages = [];

            foreach ($this->request->get('titles', []) as $key => $value) {
                $messages['titles.' . $key . '.required'] = 'The title for Image ' . ($key + 1) . ' is required.';
            }

            foreach ($this->request->get('descriptions', []) as $key => $value) {
                $messages['descriptions.' . $key . '.required'] = 'The description for Image ' . ($key + 1) . ' is required.';
            }

            foreach ($this->request->get('coins', []) as $key => $value) {
                $messages['coins.' . $key . '.required'] = 'The coin for Image ' . ($key + 1) . ' is required.';
                $messages['coins.' . $key . '.numeric'] = 'The coin for Image ' . ($key + 1) . ' must be a number.';
            }

            return $messages;
        }
}
