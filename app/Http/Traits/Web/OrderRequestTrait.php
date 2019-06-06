<?php

namespace App\Http\Traits\Web;

use App\Model\Core\Table;
use App\Model\Core\Stock;
use App\Model\Core\Product;
use App\Model\Core\Clousure;
use App\Model\Core\OrderProduct;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

trait OrderRequestTrait
{
	public function editStockAndInventary($order, $description, $opt, $shift,  $today ){

        $cousure = Clousure::
            where('store_id',Auth::user()->store()->id)
            ->where('open',1)
            ->get();
		//consultamos la cantidad que se compro por producto dentro de la orden        
        foreach($description as $order_description){

            $product = Product::find($order_description['produt_id']);
            $order_poduct = OrderProduct::
                where('order_id',$order->id)
                ->where('product_id',$product->id)
                ->get()->first();           

            if($product->buy_price){
                //al no tener un precio de compra es un producto creado                
                $product->editProductStock(array(                
                    'volume' =>  $order_poduct->volume
                ),$opt);
                //editar stock
                $stock = new Stock();            
                $stock->storeStockProduct(array(
                    'product_id' =>  $product->id,
                    'volume' =>  $order_poduct->volume,
                    'description' => 'OrderCanceled',
                    'shift' =>   $shift,
                    'rel_clousure_id' => $cousure->first()->id,
                    'date' =>  $today
                ));              
            }

            if(array_key_exists('ingredients', $order_description)){
                foreach($order_description['ingredients'] as $sub_value){                   
                    //validar el valor de selection
                    if($sub_value['value'] == "true"){
                        $sub_product = Product::find($sub_value['ingredient_id']);
                        $sub_product->editProductStockIngredient(array(                
                            'rel_id' =>  $sub_value['rel_id'],
                            'volume_product' =>  $order_poduct->volume,                       
                        ),$opt);

                        $stock = new Stock();                  
                        $stock->storeStockIngredient(array(                
                            'ingredient_id'=>$sub_value['ingredient_id'],
                            'rel_id'=>$sub_value['rel_id'],
                            'volume_product' =>  $order_poduct->volume,
                            'suggestion'=>$sub_value['suggestion'],                        
                            'shift' =>   $shift, 
                            'rel_clousure_id' => $cousure->first()->id,
                            'date' =>  $today
                        ));
                    }                  
                }
            }

            if(array_key_exists('groups', $order_description)){
                foreach($order_description['groups'] as $sub_value){
                    if($sub_value['value'] == "true"){
                        $sub_product = Product::find($sub_value['ingredient_id']);
                        $sub_product->editProductStockIngredient(array(                
                            'rel_id' =>  $sub_value['rel_id'],
                            'volume_product' =>  $order_poduct->volume,                       
                        ),$opt);
                        
                        $stock = new Stock();                  
                        $stock->storeStockIngredient(array(                
                            'ingredient_id'=>$sub_value['ingredient_id'],
                            'rel_id'=>$sub_value['rel_id'],
                            'volume_product' => $order_poduct->volume,                      
                            'shift' =>   $shift, 
                            'rel_clousure_id' => $cousure->first()->id,
                            'date' =>  $today                        
                        ));
                    }             
                }  
            }
        }

	}

    public function orderPaid(Request $request){
        //consultamos todos los detalles de todas las ordenes de la mesa vigentes
        //las ordenes que estan en estado 1
        $table = Table::select('id','name')->where('id',$request->input('table_id'))->get();
        $order_product = OrderProduct::select(
                'orders.id',
                'order_product.id as order_poduct_id',
                'order_product.status_paid',
                'order_product.ingredients',
                'order_product.volume',
                'order_product.price',
                'products.name'
                )
            ->leftJoin('orders','order_product.order_id','orders.id')
            ->leftJoin('products','order_product.product_id','products.id')
            ->leftJoin('services','orders.service_id','services.id')
            ->where('orders.status_id',2)
            ->where('services.open',1)
            ->where('services.table_id',$request->input('table_id'))            
            ->get();
        return response()->json([
            'return'=>true,
            'data'=>[
                'request'=>$request->input(),            
                'table'=>$table,
                'order_product'=>$order_product
            ]]);
    }
	
}