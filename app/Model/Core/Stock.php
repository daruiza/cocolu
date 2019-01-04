<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['id','volume','shift','description','date','product_id'];

    //a pruduct belongs a product    
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
