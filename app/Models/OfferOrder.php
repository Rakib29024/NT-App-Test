<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OfferOrder extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['product_qty_min','total_product_price_min','expiry_date','discount'];
}
