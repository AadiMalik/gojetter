<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
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
            'activity_id' => 'required|exists:activities,id',
            'activity_date_id' => 'required|exists:activity_dates,id',
            'activity_time_slot_id' => 'required|exists:activity_time_slots,id',
            'quantity' => 'required|integer|min:1',
        ];
    }
}
