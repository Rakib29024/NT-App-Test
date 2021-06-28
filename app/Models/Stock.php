<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['product_id','weight','tasteType','pricePerBox','boxQuantity'];

    /**
     * Get the product_name that owns the Stock
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product_name(): BelongsTo
    {
        return $this->belongsTo(ProductName::class,'product_id');
    }
}
