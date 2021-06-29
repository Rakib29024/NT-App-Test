<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['user_id','orderID','mobile','address','preOrder','status'];

    public function dataFormat(){
        return $this->fillable;
    }
}
