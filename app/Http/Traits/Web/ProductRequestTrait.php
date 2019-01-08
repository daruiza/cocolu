<?php

namespace App\Http\Traits\Web;

use App\Model\Core\City;
use Illuminate\Http\Request;

trait ProductRequestTrait
{	
	public function editStock(Request $request,$id){		
		return 'edit product stock';
	}	
	
}