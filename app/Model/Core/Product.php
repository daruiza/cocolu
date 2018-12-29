<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id','name','description','image1','image2','image3','order','label','active'];

    //a pruduct belongs a store    
    public function store(){
        return $this->belongsTo(Store::class);
    }

    //una tienda puede tener muchos productos
    public function stocks(){
        //no usa el namespace
        return $this->hasMany(Stock::class);
    }
}
