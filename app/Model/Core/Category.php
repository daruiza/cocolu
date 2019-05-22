<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    protected $fillable = ['id','name','description','order','active','category_id','rel_store_id'];	

    public function products(){
        //reutiliza el namespace
        return $this->belongsToMany(Product::class);
    }

    public function categories(){
    	$array = array();
        $categories = Category::
        where('active',1)
        ->where('rel_store_id',Auth::user()->store()->id)    	
        ->orderBy('id','ASC')
        ->get()
        ->toArray(); 
        foreach ($categories as $key => $value) {
        	$array[$value['id']] = $value['name'];
        }
        
        return $array;  
    }
                
}


