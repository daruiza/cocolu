<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    protected $fillable = ['id','name','description','order','active','category_id','rel_store_id'];

    public function scopeName($query,$name){
        if($name){
            return $query->where('name','LIKE',"%$name%");
        }
    }
    
    public function scopeDescription($query,$description){
        if($description){
            return $query->where('description','LIKE',"%$description%");
        }
    }

    public function scopeActive($query,$active){        
        
        if(!empty($active) || $active == "0"){            
            return $query->where('active',intval($active));
        }                
    }
	

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

    public function categoryFather(){
        
        $category = Category::select('name')
            ->where('id',$this->category_id)
            ->first();
        if($category)return $category->name;
        return '';
    }
                
}


