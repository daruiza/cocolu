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
		$ingredients = $product->ingredients()->toArray();  

		foreach ($ingredients as $key => &$value) {
            //if ingredient us a group
            if(!is_array($value)){
               if(empty(Product::where('id',$value->ingredient_id)
                    ->first()
                    ->ingredients()
                    ->first()
                    ->group)){

                    //if ingredient has ingredientes, add its to final array
                    if(Product::where('id',$value->ingredient_id)->first()->ingredients()->count()){
                        //pop actal ingrediente
                        unset($ingredients[$key]);                    
                        foreach (Product::where('id',$value->ingredient_id)
                            ->first()
                            ->ingredients() as $val){
                            
                            $ingredients[]=$val;                                               
                            
                        }                                        
                    }
                }else{
                    unset($ingredients[$key]);                    
                    $ingredients[] = Product::where('id',$value->ingredient_id)->first()->ingredients()->toArray();
                } 
            }
            
        }
		
		if(Auth::user()->validateUserStore($product->store_id)){			
			return response()->json(['respuesta'=>true,'request'=>[$request->input(),$id],'data'=>[$product,$ingredients]]);
		}

		return response()->json(['respuesta'=>true,'data'=>null]);

	}
	
}