<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Stock extends Model
{
    protected $fillable = ['id','volume','shift','description','date','product_id','rel_clousure_id'];

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
        if(array_key_exists('rel_clousure_id',$data))$this->rel_clousure_id = $data['rel_clousure_id'];
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
        if(array_key_exists('description',$data))$this->description = $data['description'];
        if(array_key_exists('date',$data))$this->date = $data['date'];
        if(array_key_exists('ingredient_id',$data))$this->product_id = $data['ingredient_id'];
        if(array_key_exists('rel_clousure_id',$data))$this->rel_clousure_id = $data['rel_clousure_id'];
        //$this->volume = $relation->volume;

        $this->save();        
    }

    static function productByClousure(Clousure $clousure){
        $products_array = array();
        $products_array['labels'] = array();
        $products_array['data'] = array();

        $products = Product::select(
            'products.name',
            'unities.name as unity',
            \DB::raw('SUM(stocks.volume) as product_volume')
        )
        ->leftJoin('stocks','products.id','stocks.product_id')
        ->leftJoin('unities','products.unity_id','unities.id')
        ->where('stocks.rel_clousure_id',$clousure->id)
        ->where('stocks.description','LIKE','sold')
        ->where('stocks.shift',0)
        ->where('products.store_id',Auth::user()->store()->id)
        ->groupBy('products.id')
        ->orderBy('product_volume', 'ASC') 
        ->get();

        foreach ($products as $key => $product) {
            $products_array['labels'][] = $product->name.'['.$product->unity.']';                    
            $products_array['data'][] = $product->product_volume;
        }

        //dd($products_array);
        /*
        $products = Order::select('products.name',
        \DB::raw('SUM(order_product.volume) as product_volume'))
        ->leftJoin('services','orders.service_id','services.id')
        ->leftJoin('clousures','services.rel_clousure_id','clousures.id')        
        ->leftJoin('order_product','orders.id','order_product.order_id')
        ->leftJoin('products','order_product.product_id','products.id') 
        ->where('clousures.id',$clousure->id)
        ->groupBy('products.id')      
        ->get();    
        */
    }
}
