<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table ='order_product';
    protected $fillable = ['order_id','status_serve','status_paid','product_id','ingredients','volume','price'];	

    public function storeOrderProduct($data){
        if(array_key_exists('order_id',$data))$this->order_id = $data['order_id'];
        if(array_key_exists('product_id',$data))$this->product_id = $data['product_id'];
        if(array_key_exists('ingredients',$data))$this->ingredients = $data['ingredients'];
        if(array_key_exists('volume',$data))$this->volume = $data['volume'];        
        if(array_key_exists('price',$data))$this->price = $data['price'];        
        $this->save();
    }
}


