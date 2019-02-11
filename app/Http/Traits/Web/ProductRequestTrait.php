<?php

namespace App\Http\Traits\Web;

use App\Model\Core\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


trait ProductRequestTrait
{	
	public function editStock(Request $request,$id){				
				
		$product = Product::find($request->input('id'));		
		if(Auth::user()->validateUserStore($product->store_id)){
			return view('product.editStock',compact('product'))->with('data', []);			
		}		
		
		Session::flash('danger', [['ProductEditStockNOOk']]);
        return redirect('product');

	}

	public function addProduct(Request $request,$id){
		//retur pruduct an his components
		
		$product = Product::find($request->input('id'));
		//componentes - buscar todos
		$components = $product->ingredients();
		
		if(Auth::user()->validateUserStore($product->store_id)){			
			return response()->json(['respuesta'=>true,'request'=>[$request->input(),$id],'data'=>[$product]]);
		}
		
		

		return response()->json(['respuesta'=>true,'data'=>null]);

	}
	
}