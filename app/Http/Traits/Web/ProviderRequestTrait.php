<?php

namespace App\Http\Traits\Web;

use Illuminate\Http\Request;

trait ProviderRequestTrait
{
	
	public function consultProvider(Request $request){
		//consultamos el proveedor	
		
		return response()->json(['respuesta'=>true,'data'=>null]);
	}	
	
}