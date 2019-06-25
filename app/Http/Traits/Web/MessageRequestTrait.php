<?php

namespace App\Http\Traits\Web;

use App\Model\Core\Store;
use App\Model\Core\Table;

use Illuminate\Http\Request;

trait MessageRequestTrait
{	
	public function request($store, Request $request){      
		//validamos los datos
		//1 existencia de la tienda
		dd($store);
		dd($request->input());
        return 'service';        
    }	
}