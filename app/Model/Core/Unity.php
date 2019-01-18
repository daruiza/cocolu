<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Unity extends Model
{
    protected $fillable = ['id','name','contract'];

    //una unidad puede estar en muchos productos
    public function products(){
        //no usa el namespace
        return $this->hasMany(Product::class);
    }

    static function unities(){
		$unities = Array();
		$unities_array = Unity::all()->toArray();        
	    foreach ($unities_array as $key => $value) {
	        $unities[$value['id']] = $value['name'];
	    }
	    return $unities;

	}
}
