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
            ->where('store_id',$this->id)
            ->orderBy('id','ASC')
            ->get();
    }

    public function ingredients(){
        //reutiliza el namespace
        //return $this->hasMany(Product::class,'ingredient_id','id');
        return \DB::table('product_product')           
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
}
