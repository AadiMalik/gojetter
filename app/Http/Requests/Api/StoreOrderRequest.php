<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'card_id'       => 'required|integer|exists:customer_cards,id',
            'currency_id'   => 'required|integer|exists:currencies,id',
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'email'         => 'required|email',
            'phone'         => 'required|string',
            'country'       => 'required|string',
            'zipcode'       => 'required|string',
            'address'       => 'required|string',
            'discount'      => 'nullable|numeric|min:0',
            'payment_method' => 'required|string',
            'coupon_id'     => 'nullable|integer'
        ];
    }
}
