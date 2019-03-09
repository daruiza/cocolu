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

    public function storeStockProduct($data){
        if(array_key_exists('volume',$data))$this->volume = $data['volume'];
        if(array_key_exists('shift',$data))$this->shift = $data['shift'];
        if(array_key_exists('description',$data))$this->description = $data['description'];
        if(array_key_exists('date',$data))$this->date = $data['date'];
        if(array_key_exists('product_id',$data))$this->product_id = $data['product_id'];        
        $this->save();
    }

    public function storeStockIngredient($data){

        $relation = \DB::table('product_product')           
            ->where('id',$data['rel_id'])
            ->get()
            ->first();

        $this->volume = $relation->volume*$data['volume_product'];
        if(array_key_exists('shift',$data))$this->shift = $data['shift'];
        if(array_key_exists('suggestion',$data))$this->description = $data['suggestion'];
        if(array_key_exists('date',$data))$this->date = $data['date'];
        if(array_key_exists('product_id',$data))$this->product_id = $data['ingredient_id'];        

        $this->save();
    }
}
