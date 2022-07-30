<?php

namespace App\Http\Requests\API\Apartment;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'titles' => 'nullable|string',
            'prices' => 'nullable|array',
            'bedrooms' => 'nullable|array',
            'bathrooms' => 'nullable|array',
            'storeys' => 'nullable|array',
            'garages' => 'nullable|array',
        ];
    }
}
