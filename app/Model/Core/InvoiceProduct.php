<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    protected $table ='invoice_product';
    protected $fillable = ['id','price','volume','invoice_id','product_id'];	

    public function storeInvoiceProduct($data){
        if(array_key_exists('price',$data))$this->price = $data['price'];
        if(array_key_exists('volume',$data))$this->volume = $data['volume'];
        if(array_key_exists('invoice_id',$data))$this->invoice_id = $data['invoice_id'];
        if(array_key_exists('product_id',$data))$this->product_id = $data['product_id'];        
        $this->save();
    }

    public function updateInvoiceProduct($data){
        if(array_key_exists('price',$data))$this->price = $data['price'];
        if(array_key_exists('volume',$data))$this->volume = $data['volume'];        
        $this->save();
    }
}


