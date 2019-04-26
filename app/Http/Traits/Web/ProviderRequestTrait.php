<?php

namespace App\Http\Traits\Web;

use App\Model\Core\Provider;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

trait ProviderRequestTrait
{
	
	public function consultProvider(Request $request){
		
		if(empty($request->input('number'))){
			return response()->json(['respuesta'=>true,'data'=>null]);
		}

		//validamos la tienda		
		if(!Auth::user()->validateUserStore($request->input('storeid'))){
			return response()->json(['respuesta'=>true,'data'=>null]);
		}

		//consultamos el provider		
		$provider = Provider::
			where('number','LIKE',$request->input('number'))				
			->where('store_id',$request->input('storeid'))
			->get()->first();			
		return response()->json(['respuesta'=>true,'userid'=>Auth::user()->id,'data'=>$provider]);
	}	
	
}