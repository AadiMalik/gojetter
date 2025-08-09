<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class GetActivityListRequest extends FormRequest
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
            'type'  => 'sometimes|string|in:private,group',
            'search'  => 'sometimes|string|max:255',
            'category_id'  => 'sometimes|integer',
            'sort_by'  => 'sometimes|string|max:255',
        ];
    }
}
