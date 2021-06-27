<?php

namespace App\Http\Resources\stock;

use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'product_id'=>$this->product_id,
            'weight'=>$this->weight,
            'tasteType'=>$this->tasteType,
            'pricePerBox'=>$this->pricePerBox,
            'boxQuantity'=>$this->boxQuantity
        ];
    }
}
