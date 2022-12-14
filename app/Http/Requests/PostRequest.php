<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PostRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|email:dns|unique:users',
            'address' => 'required|min:5',
            'gender' => 'required',
            'Agreement' => 'required',
            'password' => 'required|confirmed|min:5',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:4096'
        ];
    }
    public function messages()
    {
        return [
            'Agreement.required' => 'You must agree to our terms and conditions'
        ];
    }
}
