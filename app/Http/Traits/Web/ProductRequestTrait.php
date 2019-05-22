<?php

namespace App\Http\Traits\Web;

use App\Model\Core\Product;
use App\Model\Core\Provider;
use App\Model\Core\Invoice;
use App\Model\Core\Stock;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use DateTime;

trait ProductRequestTrait
{	
	public function addProduct(Request $request,$id){
		//retur pruduct an his components		
		//$product = Product::find($request->input('id'));
        $product = Product::select('id','name','price','volume','description','image1','order','label','unity_id','store_id','buy_price')
        ->where('id',$request->input('id'))
        ->first();
        //componentes - buscar todos        
        $components = $product->ingredients()->toArray();  
        
        //gestion de ingredientes
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

    public function editStock(Request $request,$id){                
        
        $product = Product::find($request->input('id'));        
        if(Auth::user()->validateUserStore($product->store_id)){            
            return view('product.editStock',compact('product'))->with('data', []);          
        }
        
        Session::flash('danger', [['ProductEditStockNOOk']]);
        return redirect('product');
    }

    public function saveStock(Request $request,$id){

        $this->validatorEditStock($request->all())->validate();

        //validar store
        if(Auth::user()->validateUserStore($request->input('store_id'))){
            
            $product = Product::find($request->input('product_id'));           
        
            $volume = $request->input('volume_change');

            //edit stock
            $stock = new Stock();
            $request->request->add(['product_id' => $request->input('product_id')]);                    
            $today = new DateTime();
            $today = $today->format('Y-m-d H:i:s'); 
            $request->request->add(['date' => $today]);       
            $request->request->add(['shift' => 1]);//entrada        
            if(intval($request->input('volume_change'))<0){            
                $request->request->add(['shift' => 0]);//sale
                $volume = abs(intval($volume));
            }
            $request->request->add(['volume'=>$volume]);      
            $request->request->add(['description'=>$request->input('description_change')]);      
            $stock = $stock::create($request->input());


            $product->editProductStockUp(['volume'=>$request->input('volume_change')]);
            $product->save();

            Session::flash('success', [['ProductEditStockOk']]);
            return redirect('product');

        }

        

        
    }
	
}