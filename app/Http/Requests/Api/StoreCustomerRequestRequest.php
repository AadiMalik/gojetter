<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequestRequest extends FormRequest
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
            'sub_service_id'   => 'required|exists:sub_services,id',
            'name'             => 'required|string|max:255',
            'email'            => 'nullable|email|max:255',
            'phone'            => 'required|string|max:50',
            'country'          => 'nullable|string|max:100',
            'city'             => 'nullable|string|max:100',
            'age'              => 'nullable|integer',
            'medical_history'  => 'nullable|string',
            'gender'           => 'nullable|in:male,female,other',
            'file'             => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'specific_date'    => 'nullable|date'
        ];
    }
}
