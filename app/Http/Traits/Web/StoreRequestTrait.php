<?php

namespace App\Http\Traits\Web;

use App\Model\Core\Store;

use Illuminate\Http\Request;

trait StoreRequestTrait
{
	
	public function mystore(Request $request,$store){
		$store = Store::where('name', strtolower($store))->firstOrFail();		
		//return view('store.index',compact('store'));

	}
	
}