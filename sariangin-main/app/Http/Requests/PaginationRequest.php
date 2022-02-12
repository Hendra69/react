<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginationRequest extends FormRequest
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
            'paginate' => 'nullable|in:true,false',
            'page' => 'nullable|integer',
            'perPage' => 'nullable|integer',
            'sortKey' => 'nullable',
            'sortOrder' => 'nullable|in:asc,desc',
            'search' => 'nullable|string',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'filters' => json_decode($this->filters, true),
        ]);
    }
}
