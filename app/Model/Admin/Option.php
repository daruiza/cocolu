<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['id','name','label','active','module_id'];    

     //una opcion pertenece a un modulo
    public function module(){
        return $this->belongsTo(Module::class);
    }

    public function rols(){
        return $this->belongsToMany(Rol::class);
    }


}
