<?php

namespace App\Http\Traits\Web;

use App\Model\Core\City;
use Illuminate\Http\Request;

trait HomeRequestTrait
{
	
	public function consultarcity(Request $request){
		//consultamos el departamento
		
		if(!empty($request->input()['id'])){						

			$cities = City::cities($request->input()['id']);
			if(count($cities)){
				return response()->json(['respuesta'=>true,'data'=>$cities]);
			}
		}
		return response()->json(['respuesta'=>true,'data'=>null]);
	}	
	
}