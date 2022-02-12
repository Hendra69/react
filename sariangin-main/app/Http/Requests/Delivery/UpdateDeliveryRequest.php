<?php

namespace App\Http\Requests\Delivery;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryRequest extends FormRequest
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
            'date' => 'required|date',
            'type' => 'required|string',
            'customer_id' => 'required|integer|exists:customers,id',
            'tank_categories' => 'required|array',
            'driver_id' => 'required|integer|exists:users,id',
            'vehicle_id' => 'required|integer|exists:vehicles,id',
            'note' => 'nullable|string',
        ];
    }
}
