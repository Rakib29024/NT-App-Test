<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['user_id','orderID','mobile','address','preOrder','status'];

    public function dataFormat(){
        return $this->fillable;
    }
}
