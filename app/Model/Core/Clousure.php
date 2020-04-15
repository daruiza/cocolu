<?php

namespace App\Model\Core;

use App\Model\Core\Service;
use Illuminate\Database\Eloquent\Model;

class Clousure extends Model
{
    protected $fillable = ['id','name','description','open','date_open','date_close','store_id'];

    //una cierre pertenece a una tienda
    public function store(){
        return $this->belongsTo(Store::class);
    }

    //Query Scope    
    public function scopeName($query,$name){
        if($name){
            return $query->where('clousures.name','LIKE',"%$name%");
        }
    }
    public function scopeDescription($query,$description){
        if($description){
            return $query->where('clousures.description','LIKE',"%$description%");
        }
    }

    public function scopeDate_open($query,$date_open){
        if($date_open){
            return $query->where('clousures.date_open','LIKE',"%$date_open%");
        }
    }


    //un ciere puede estar en muchos servicios    
    public function servicesAll(){
        return Service::where('rel_clousure_id', $this->id)        
        ->get();        
    }

    public function services(){
        return Service::where('rel_clousure_id', $this->id)
        ->where('open',1)
        ->get();		
    }

    public function servicesBuilder(){
        return Service::where('rel_clousure_id', $this->id)
        ->where('open',1);        
    }    
}
