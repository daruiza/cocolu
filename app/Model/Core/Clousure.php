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

    //un ciere puede estar en muchos servicios    
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
