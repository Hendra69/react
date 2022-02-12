<?php

namespace App\Http\Requests\Tank;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTankRequest extends FormRequest
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
            'serial_number' => 'required|string|unique:tanks,serial_number,' . $this->tank->id,
            'status' => 'required|string',
            'location' => 'required|string',
            'note' => 'nullable|string',
        ];
    }
}
