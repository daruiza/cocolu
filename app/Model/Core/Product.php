<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    protected $fillable = ['id','name','price','buy_price','volume','critical_volume','description','image1','image2','image3','order','label','active','unity_id','store_id'];

    //a pruduct belongs a store    
    public function store(){
        return $this->belongsTo(Store::class);
    }

    //a pruduct belongs a store    
    public function unity(){
        return $this->belongsTo(Unity::class);
    }

    //a product may have many stocks
    public function stocks(){
        //no usa el namespace
        return $this->hasMany(Stock::class);
    }

    public function categories(){
        //reutiliza el namespace
        return $this->belongsToMany(Category::class);
    }

    public function orders(){
        //reutiliza el namespace
        return $this->belongsToMany(Order::class);
    }

    public function products(){
        //reutiliza el namespace
        //return $this->belongsToMany(Product::class,'product_id','id');
        return \DB::table('product_product')           
            ->where('ingredient_id',$this->id)
            ->where('store_id',$this->store_id)
            ->orderBy('id','ASC')
            ->get();
    }

    public function ingredients(){
        //reutiliza el namespace
        //return $this->hasMany(Product::class,'ingredient_id','id');
        return \DB::table('product_product') 
            ->select('product_product.id','product_product.ingredient_id','product_product.product_id','product_product.volume as volume_product','product_product.group','products.name as product','products.volume','unities.name as unity')       
            ->leftJoin('products','products.id','product_product.ingredient_id')
            ->leftJoin('unities','unities.id','products.unity_id')
            ->where('product_id',$this->id)
            ->orderBy('id','ASC')
            ->get();            
    }

    public function ingredientsAsProduct(){
        //reutiliza el namespace
        //return $this->hasMany(Product::class,'ingredient_id','id');
        return \DB::table('products')
            ->leftJoin('product_product')      
            ->where('product_id',$this->id)
            ->orderBy('id','ASC')
            ->get();            
    }

    static function getProducts(){
        return Product::where('store_id',Auth::user()->store()->id)
            ->where('products.active',1);            
    }

    static function productsArray(){
        $products = Array();
        $products_array = Product::getProducts()->orderBy('products.name','ASC')->get();        
        foreach ($products_array as $key => $value) {
            $products[$value->id] = $value->name.' - ('.$value->unity->name.')';
        }
        return $products;
    }

    static function productsArrayCategoryDefault(){
        $products = Array();
        $products_array = Product::getProducts()
            ->leftJoin('category_product','products.id','product_id')
            ->where('category_product.category_id',1)
            ->orderBy('products.name','ASC')->get();                
        foreach ($products_array as $key => $value) {
            $products[$value->product_id] = $value->name.' - ('.$value->unity->name.')';
        }
        return $products;
    }

    static function productstByStore(){
        
        return Product::getProducts()
            ->select('products.*','categories.name as category','categories.order as order_category')
            ->rightJoin('category_product','products.id','product_id')
            ->leftJoin('categories','category_product.category_id','categories.id')            
            ->where('categories.active',1)
            ->where('categories.category_id',"<>",0)
            ->orderBy('categories.order','ASC')
            ->orderBy('products.order','ASC')
            ->get();
    }

    

    public function categories_toString(){
        $string = "";
        foreach ($this->categories()->get() as $key => $value) {
            $string  = $string.$value->name." - ";
        }
        return substr($string,0,-3);
    }

    public function critical_volume_calc(){
        if($this->critical_volume){
            if($this->volume <= $this->critical_volume) return true;
            return false;
        }        
        return false;        
    }

    public function editProductStock($data,$opt=false){
        
        if(!$opt){
            //decrementar
            if($this->volume){
                if(array_key_exists('volume',$data))$this->volume = $this->volume - $data['volume'];    
                $this->save();
            }
        }else{
            //incrementar
            if($this->buy_price){
                if(array_key_exists('volume',$data))$this->volume = $this->volume + $data['volume'];    
                $this->save();
            }
        }
                
    }

    public function editProductStockUp($data){
        if($this->buy_price){
            if(array_key_exists('volume',$data))$this->volume = $this->volume + $data['volume'];    
            $this->save();
        }        
    }

    public function editProductStockIngredient($data,$opt=false){
        
        if(!$opt){
            //decrementar
            //consultamos el volumen
            $relation = \DB::table('product_product')           
                ->where('id',$data['rel_id'])
                ->get()
                ->first();
            if($this->volume){
                $this->volume = $this->volume - $relation->volume * $data['volume_product'];    
                $this->save();
            }
        }else{
            //incrementar
            //consultamos el volumen
            $relation = \DB::table('product_product')           
                ->where('id',$data['rel_id'])
                ->get()
                ->first();
            if($this->volume){
                $this->volume = $this->volume + $relation->volume * $data['volume_product'];    
                $this->save();
            }       
        }
               
    }

    public function editProductStockIngredientUp($data){
        //consultamos el volumen
        $relation = \DB::table('product_product')           
            ->where('id',$data['rel_id'])
            ->get()
            ->first();
        if($this->volume){
            $this->volume = $this->volume + $relation->volume * $data['volume_product'];    
            $this->save();
        }       
    }

    static function productByClousure(Clousure $clousure){
        $products_array = array();
        $products_array['labels'] = array();
        $products_array['data'] = array();
        //consultamos las ordenes pagas
        $products = Order::select('products.name',
        \DB::raw('SUM(order_product.volume) as product_volume'))
        ->leftJoin('services','orders.service_id','services.id')
        ->leftJoin('clousures','services.rel_clousure_id','clousures.id')        
        ->leftJoin('order_product','orders.id','order_product.order_id')
        ->leftJoin('products','order_product.product_id','products.id') 
        ->where('clousures.id',$clousure->id)
        ->groupBy('products.id')      
        ->get();    
        foreach ($products as $key => $product) {
            $products_array['labels'][] = $product->name;                    
            $products_array['data'][] = $product->product_volume;
        }    
        return $products_array;
    }
    
}
