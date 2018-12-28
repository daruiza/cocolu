<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Clousure extends Model
{
    protected $fillable = ['id','name','description','open','store_id'];

     //una mesa pertenece a una tienda
    public function store(){
        return $this->belongsTo(Store::class);
    }
}
