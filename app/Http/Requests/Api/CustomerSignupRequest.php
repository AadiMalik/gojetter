<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CustomerSignupRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'     => 'required|string|max:255',
            'username' => ['required','string','max:255','unique:users','regex:/^\S+$/'],
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
