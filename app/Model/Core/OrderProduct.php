<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table ='order_product';
    protected $fillable = ['order_id','product_id','ingredients','volume'];	

    public function storeOrderProduct($data){
        if(array_key_exists('order_id',$data))$this->order_id = $data['order_id'];
        if(array_key_exists('product_id',$data))$this->product_id = $data['product_id'];
        if(array_key_exists('ingredients',$data))$this->ingredients = $data['ingredients'];
        if(array_key_exists('volume',$data))$this->volume = $data['volume'];        
        $this->save();
    }
}


