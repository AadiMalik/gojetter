<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required|string',
            'phone'=> 'required|string',
            'gender'=> 'required|string',
            'country_id'=> 'required|integer',
            'avatar' => 'nullable|image',
            'is_show_email_phone'=>'required|in:0,1',
            'home_airport'=>'required|string',
            'state'=>'nullable|string',
            'city'=>'nullable|string',
            'address'=>'nullable|string',
            'zip_code'=>'nullable|string',
            'paypal_email'=> 'nullable|string',
            'alternative_phone'=>'nullable|string',
        ];
    }
}
