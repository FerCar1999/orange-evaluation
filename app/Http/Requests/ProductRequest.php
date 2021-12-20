<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'sku' => 'nullable',
            'name' => 'required',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0.01',
            'description' => 'nullable',
            'image' => 'nullable|file',
        ];
    }
}
