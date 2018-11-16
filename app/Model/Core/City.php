<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['id','code','name','department_id'];


    static function cities($department_id){
		$cities = Array();
		$cities_array = City::where('cities.department_id', $department_id)
		->orderBy('name','asc')
		->get()
		->toArray();		
	    foreach ($cities_array as $key => $value) {
	        $cities[$value['id']] = $value['name'];
	    }
	    return $cities;
	}
}

	


