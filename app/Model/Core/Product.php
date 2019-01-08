<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id','name','price','buy_price','volume','critical_volume','description','image1','image2','image3','order','label','active','store_id'];

    //a pruduct belongs a store    
    public function store(){
        return $this->belongsTo(Store::class);
    }

    //a product may have meny stocks
    public function stocks(){
        //no usa el namespace
        return $this->hasMany(Stock::class);
    }

    public function categories(){
        //reutiliza el namespace
        return $this->belongsToMany(Category::class);
    }

    public function categories_toString(){
        $string = "";
        foreach ($this->categories()->get() as $key => $value) {
            $string  = $string.$value->name." - ";
        }
        return substr($string,0,-3);
    }

    public function critical_volume(){
        if($this->volume <= $this->critical_volume) return true;
        return false;
    }
}
