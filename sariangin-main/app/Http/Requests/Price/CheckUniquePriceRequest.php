<?php

namespace App\Http\Requests\Price;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class CheckUniquePriceRequest extends FormRequest
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
        $rules = [
            'tank_category_id' => 'required|integer|exists:tank_categories,id',
            'customer_type' => 'required|string|unique_with:prices,tank_category_id',
        ];

        if ($this->price) {
            $rules['customer_type'] += ",{$this->price->id}";
        }

        return $rules;
    }
}
