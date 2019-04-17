<?php

namespace App\Http\Traits\Web;

use App\Model\Core\Product;
use App\Model\Core\Provider;
use App\Model\Core\Invoice;

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

    //entrega los datos de los productos para realizar una factura de compra
    public function purchaseOrder(){
        
        //0. validaciones
        //No valida, solo entrega, luego el metodo de store valida

        //1. consultamos los productos - todos. tener en cuenta si no hay
        $invoice = new Invoice();
        $products = Product::            
            where('active',1)
            ->where('store_id',Auth::user()->store()->id)
            ->orderBy('id','ASC')
            ->get();
        if(!$products->count()){
            Session::flash('info', [['PurchageOrderNoProducts']]);
            return redirect('product');
        }
        
        //2. consultamos los proveedores - todos        
        $providers = Provider::            
            where('active',1)
            ->where('store_id',Auth::user()->store()->id)
            ->orderBy('id','ASC')
            ->get();
        
        return view('invoice.create',compact('invoice','providers'))->with('data', []);
    }
    

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
	
}