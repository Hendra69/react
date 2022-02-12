<?php

namespace App\Http\Requests\Price;

use Illuminate\Foundation\Http\FormRequest;

class StorePriceRequest extends FormRequest
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
            'tank_category_id' => 'required|integer|exists:tank_categories,id',
            'customer_type' => 'required|string|unique_with:prices,tank_category_id',
            'price' => 'required|integer',
        ];
    }
}
