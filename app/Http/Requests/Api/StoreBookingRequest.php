<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'tour_id'       => 'required|integer|exists:tours,id',
            'tour_date'     => 'required|date|date_format:Y-m-d',
            // 'tour_date_id'  => 'required|integer|exists:tour_dates,id',
            'card_id'       => 'required|integer|exists:customer_cards,id',
            'currency_id'   => 'required|integer|exists:currencies,id',
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'email'         => 'required|email',
            'phone'         => 'required|string',
            'country'       => 'required|string',
            'zipcode'       => 'required|string',
            'address'       => 'required|string',
            'quantity'      => 'required|integer|min:1',
            'sub_total'     => 'required|numeric|min:0',
            'tax_percent'   => 'nullable|numeric|min:0',
            'tax_amount'    => 'nullable|numeric|min:0',
            'discount'      => 'nullable|numeric|min:0',
            'total'         => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'coupon_id'     => 'nullable|integer',
            'booking_details' => 'required|array|min:1',
            'booking_details.*.first_name' => 'required|string',
            'booking_details.*.last_name'  => 'required|string',
            'booking_details.*.type'       => 'required|in:adult,child',
            'booking_details.*.dob'        => 'nullable|date',
            'booking_details.*.weight'     => 'nullable|string',
            'booking_details.*.weight_unit' => 'nullable|string',
        ];
    }
}
