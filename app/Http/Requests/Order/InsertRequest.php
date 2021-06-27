<?php

namespace App\Http\Requests\Order;

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
            'user_id'=>'required|numeric',
            'orderID'=>'nullable',
            'mobile'=>'required|max:20',
            'address'=>'required|max:255',

            'order_id*'=>'nullable|numeric',
            'quantity*'=>'required|numeric',
            'stock_id*'=>'required|numeric',
            'totalProductPrice'=>'nullable',
            'deliveryCost'=>'nullable',
        ];
    }
}
