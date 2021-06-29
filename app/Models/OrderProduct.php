<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProduct extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['order_id','stock_id','quantity','deliveryCost','totalProductPrice','discount'];
}
