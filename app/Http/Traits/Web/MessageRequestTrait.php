<?php

namespace App\Http\Traits\Web;

use App\Model\Core\Store;
use App\Model\Core\Table;

use Illuminate\Http\Request;

trait MessageRequestTrait
{	
	public function request($id_store, $id_table, Request $request){      
		//validamos los datos
		//1 existencia de la tienda		
		$store = Store::findOrFail($id_store);
		$table = Table::findOrFail($id_table)->where('store_id',$id_store);

		//request
		$request = array();

        return view('message.request_store',compact('store','table','request'));
    }	
}