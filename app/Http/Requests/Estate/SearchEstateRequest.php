<?php

namespace App\Http\Requests\Estate;

use App\DataTransferObjects\Estate\SearchEstateData;
use Illuminate\Foundation\Http\FormRequest;

class SearchEstateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'price_classification' => [
                'nullable',
                'string',
                'max:2',
            ],
            'year' => [
                'required',
                'integer',
            ],
            'quarter' => [
                'nullable',
                'integer',
                'digits:1',
            ],
            'area' => [
                'nullable',
                'string',
            ],
            'city' => [
                'nullable',
                'integer',
                'digits:5',
            ],
        ];
    }

    /**
     * getSearchData
     *
     * @return SearchEstateData
     */
    public function getSearchData(): SearchEstateData
    {
        return SearchEstateData::from([
            'priceClassification' => $this->query('price_classification'),
            'year' => $this->query('year'),
            'quarter' => $this->query('quarter'),
            'area' => $this->query('area'),
            'city' => $this->query('city'),
        ]);
    }
}
