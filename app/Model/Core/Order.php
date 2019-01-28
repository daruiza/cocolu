<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable = ['id','description','date','active','waiter_id','service_id'];	
    
    public function products(){
        //reutiliza el namespace
        return $this->belongsToMany(Product::class);
    }
}
