<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;
use App\Model\Core\Department;

class Department extends Model
{
    protected $fillable = ['id','code','name'];

    static function departments(){
		$departments = Array();
		$departments_array = Department::all()->toArray();        
	    foreach ($departments_array as $key => $value) {
	        $departments[$value['id']] = $value['name'];
	    }
	    return $departments;

	}
}


