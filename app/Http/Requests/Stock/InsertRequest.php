<?php

namespace App\Http\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;

class InsertRequest extends FormRequest
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
            'product_id' => 'required|numeric',
            'weight' => 'required|numeric',
            'tasteType' => 'required',
            'pricePerBox' => 'required|numeric',
            'boxQuantity' =>'required|numeric'
        ];
    }
}
