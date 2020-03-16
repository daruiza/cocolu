<?php 

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\Core\Product;
use App\Model\Core\Order;
use App\Model\Core\OrderProduct;
use App\Model\Core\Service;
use App\Model\Core\Stock;
use App\Model\Core\Waiter;
use App\Model\Core\Clousure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DateTime;

class OrderController extends Controller{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request->user());
        // $table = Table::find($request->input('params'));
        // return response()->json($request->input());

        $cousure = Clousure::
            where('store_id',$request->user()['rel_store_id'])
            ->where('open',1)
            ->get();

        if($cousure->count() <> 1){
            return response()->json(['message' => 'NO_ONLYONE_CLOUSURE'], 404);
        }        

        $products = $request->input('order')['products'];
        if(!count($products)){
            return response()->json(['message' => 'NO_ORDER_SAVE'], 404);
        }

        $obj_res = array(
            'table' => $request->input('table'),
            'service' => $request->input('service'),
            'order_form' => $request->input('order'),
            'total' => 0
        );

        //1. crear el servicio y la orden de pedido
        $service = Service::find($request->input('service')['id']);      
        $order = new Order();
        
        $today = new DateTime();
        $today = $today->format('Y-m-d H:i:s');        

        $request->request->add(['date' => $today]);
        $request->request->add(['description' => json_encode($products)]);
        $request->request->add(['description' => $request->input('order')['user']]);                
        $request->request->add(['service_id' => $service->id]);
        $request->request->add(['waiter_id' => $request->input('order')['waiter']]);
        $request->request->add(['serial' => $order->nextSerial($service)]);

        $obj_order = $order::create($request->input());
        
        foreach ($products as $key_product => $value_product) {
            $product = Product::find($value_product['id']);
            if($product->buy_price){
                // descuento de producto
                $product->editProductStock(array(                
                    'volume' =>  1                
                ));

                //Descuento de producto en stock     
                $stock = new Stock();
                $stock->storeStockProduct(array(
                    'product_id' =>  $product->id,
                    'volume' =>  1,
                    'shift' =>  0,
                    'rel_clousure_id' => $cousure->first()->id,
                    'description'=>'sold',
                    'date' =>  $today
                ));   
            }

            // Los Ingredientes
            $ingredients = $product->ingredients();
            if(count($ingredients)){
                foreach ($ingredients as $key_ingredient => $value_ingredient) {
                    // descuento de ingrediente en stock
                    if(!$value_ingredient->group){

                        // desuento de ingrediente en producto                    
                        $product_ingredient = Product::find($value_ingredient->ingredient_id);
                        $product_ingredient->editProductStock(array(                
                            'volume' =>  $value_ingredient->volume_product
                        ));

                        // descontamos de stock los ingredientes
                        $stock = new Stock();
                        $stock->storeStockProduct(array(
                            'product_id' =>  $value_ingredient->id,
                            'volume' =>  $value_ingredient->volume_product,
                            'shift' =>  0,
                            'rel_clousure_id' => $cousure->first()->id,
                            'description'=>'sold',
                            'date' =>  $today
                        )); 
                    }
                }
            }

            //2.1 relacion con order products
            $order_product = new OrderProduct();                  
            $order_product->storeOrderProduct(array(                
                'order_id'=>$obj_order->id,
                'product_id'=>$value_product['id'],
                'ingredients' =>  json_encode($ingredients),                      
                'volume' =>  $value_product['volume'],
                'price' => $value_product['price']
            ));

            // respuesta
            $obj_res['total'] = $obj_res['total'] + $value_product['price'];
        }  

        $obj_res['order'] = $obj_order;
        return response()->json($obj_res);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function products(Request $request){
        
        $waiters = Waiter::waitersByStoreSelect($request->user()->rel_store_id); 
        $products = Product::productstByStore($request->user()->rel_store_id);
        $categories = array();

        foreach ($products as $value) {
            if(!in_array($value->category,$categories))$categories[]=$value->category;
        }
        
        return response()->json([
            'products'=>$products,
            'categories'=>$categories,
            'waiters' =>$waiters
        ]);
    }

}