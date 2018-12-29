<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['id','volume','price','buy_price','date'];

    //a pruduct belongs a product    
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
