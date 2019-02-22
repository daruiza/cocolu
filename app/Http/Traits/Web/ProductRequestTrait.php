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
        $components = $product->ingredients()->toArray();  
        
        //gstion de ingredientes
        foreach ($components as $key => &$value) {
            
            if(!is_array($value)){
                //el ingrediente del ingrediente no es una agrupacion, es un ingrdiente normal
               if(empty(Product::where('id',$value->ingredient_id)
                    ->first()
                    ->ingredients()
                    ->first()
                    ->group)){

                    //if ingredient has ingredients, add its to final array
                    if(Product::where('id',$value->ingredient_id)->first()->ingredients()->count()){
                        //pop actal ingrediente
                        unset($components[$key]);                    
                        
                        foreach (Product::where('id',$value->ingredient_id)
                            ->first()
                            ->ingredients() as $val){
                            
                            $components[]=$val;
                        }                                                               
                    }

                    //si el ingrediente tiene una agrupacion
                    if(!empty($value->group)){
                        unset($components[$key]);
                        $components[$value->group][] = $value;
                    }

                }else{
                    //el ingrediente es una agrupación                    
                    unset($components[$key]);                    
                    $components[] = Product::where('id',$value->ingredient_id)->first()->ingredients()->toArray();
                }
            }
            
        }

        $ingredients = array();
        foreach ($components as $key => &$value) {
            $ingredients[] = $value;
        }       
		
		if(Auth::user()->validateUserStore($product->store_id)){			
			return response()->json(['respuesta'=>true,'request'=>[$request->input(),$id],'data'=>[$product,$ingredients]]);
		}

		return response()->json(['respuesta'=>true,'data'=>null]);

	}
	
}