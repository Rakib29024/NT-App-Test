<?php

namespace App\Http\Resources\product;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductNameCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'data'=>ProductNameResource::collection($this->collection)
        ];
    }
}
