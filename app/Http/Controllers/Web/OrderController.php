<?php

namespace App\Http\Controllers\Web;

use App\Model\Core\Table;
use App\Model\Core\Order;
use App\Model\Core\Stock;
use App\Model\Core\Waiter;
use App\Model\Core\Product;
use App\Model\Core\OrderProduct;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use DateTime;

class OrderController extends Controller
{

    public function __construct()
    {               
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $table = Table::find($request->input('table-id'));
        //$service = $table->tableServiceOpen();

        if(!Auth::user()->validateUserStore($table->store_id)){
            //return tableController->index();
            //return view('table.index',compact('table'))->with('danger', [['NO_STORE_OWNER']])->with('data', []);
            //return Redirect::back()->with($request->input())->with('danger', [['NO_STORE_OWNER']])->with('data', []);            
            //return view('table.index',compact('tables'))->with('data', [])->with('danger', [['NO_STORE_OWNER']]);
            Session::flash('danger', [['NO_STORE_OWNER']]);
            return redirect('table');
        }

        //$ordermodal = true;
        //return redirect('table');
        //return redirect('table')->route('newPr')->withErrors(compact('state'));
        //return redirect('table')->with(compact('ordermodal'));
        //return redirect('table')->with('data', ['ordermodal'=>true,'table_id'=>$table->id]);
        $tables = Table::where('store_id',Auth::user()->store()->id)
            ->where('active',1)
            ->orderBy('id','ASC')
            ->get();

        $waiters = Waiter::waitersByStoreSelect();                                 
        $products = Product::productstByStore();             
        $categories = array();                        

        foreach ($products as $value) {
            if(!in_array($value->category,$categories))$categories[]=$value->category;
        }
        
        return view('table.index',compact('tables','table','waiters','products','categories'))->with('data', ['ordermodal'=>true,'table_id'=>$table->id]
        );
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        //validamos        
        $table = Table::find($request->input('table-id'));
        $service = $table->tableServiceOpen()->first();

        if(!Auth::user()->validateUserStore($table->store_id)){
            Session::flash('danger', [['NO_STORE_OWNER']]);
            return redirect('table');
        }
        
        //preparación de datos        
        //productos
        //constitucion
        //ingr_0_12_10_13
        /*
        1. consecutivo
        2. Id de producto
        3. Id Ingrediente
        4. Id de relacion en prod_prod
        */

        $products = array();
        $i = -1;
        //dd($request->input());
        foreach ($request->input() as $key => $value) {
            $array = explode('_',$key);                
            if(count($array) > 1){
                if(is_numeric($array[1])){
                    //product id
                    if($array[0] == 'prod'){
                        $products[$array[1]]['produt_id'] = $array[3];
                        $products[$array[1]]['volume'] = $value ;
                    }
                    if($array[0] == 'pric'){
                        $products[$array[1]]['volume_store'] = $array[3];
                        $products[$array[1]]['price'] = $value ;
                    }
                    if($array[0] == 'prom'){
                        $products[$array[1]]['name'] = $array[3];
                        $products[$array[1]]['image'] = $value ;
                    }
                    if($array[0] == 'ingr'){
                        $products[$array[1]]['ingredients'][$array[3]]['ingredient_id'] = $array[3];
                        $products[$array[1]]['ingredients'][$array[3]]['value'] = $value;
                        $products[$array[1]]['ingredients'][$array[3]]['rel_id'] = $array[4];
                    }
                    if($array[0] == 'sugg'){
                        $products[$array[1]]['ingredients'][$array[3]]['suggestion'] = $value;
                    }
                    if($array[0] == 'ingm'){
                        $products[$array[1]]['ingredients'][$array[3]]['name'] = $array[4];
                        $products[$array[1]]['ingredients'][$array[3]]['unity'] = $value;
                    }
                    if($array[0] == 'ingv'){
                        $products[$array[1]]['ingredients'][$array[3]]['volume'] = $array[4];
                        $products[$array[1]]['ingredients'][$array[3]]['volume_product'] = $value;
                    }
                    if($array[0] == 'grou'){
                        $products[$array[1]]['groups'][$array[3]]['ingredient_id'] = $array[3];
                        $products[$array[1]]['groups'][$array[3]]['rel_id'] = $array[4];
                        $products[$array[1]]['groups'][$array[3]]['value'] = $value;
                    }
                    if($array[0] == 'grom'){
                        $products[$array[1]]['groups'][$array[3]]['name'] = $array[4];
                        $products[$array[1]]['groups'][$array[3]]['unity'] = $value;
                    }
                    if($array[0] == 'grov'){
                        $products[$array[1]]['groups'][$array[3]]['volume'] = $array[4];
                        $products[$array[1]]['groups'][$array[3]]['volume_product'] = $value;
                    }
                }                
            }
        }
        //dd($products);
        if(!count($products)){
            Session::flash('danger', [['NO_ORDER_SAVE']]);
            return redirect('table');    
        }
        

        //1. crear la orden de pedido
        $order = new Order();
        //fecha y hora
        $today = new DateTime();
        $today = $today->format('Y-m-d H:i:s');     
        $request->request->add(['date' => $today]);
        $request->request->add(['description' => json_encode($products)]);                
        $request->request->add(['service_id' => $service->id]);
        $request->request->add(['serial' => $order->nextSerial($service)]);
        $obj_order=$order::create($request->input());
                
        $ingredients = array();//para almacenar los ingredientes
        //2. descontar de inventario, 2 procesos (movimiento y descuento)
        //hay que buscar la relación del producto y el ingrediente
        
        foreach ($products as  $key => $value) {           
            //primero descontamos en stock
            $stock = new Stock();
            $stock->storeStockProduct(array(
                'produt_id' =>  $value['produt_id'],
                'volume' =>  $value['volume'],
                'shift' =>  0, 
                'date' =>  $today
            ));

            if(array_key_exists('ingredients',$value)){
                //descuento por ingrediente * cantidad pedida
                foreach ($value['ingredients'] as  $sub_value) {                  
                    if($sub_value['value'] == "true"){
                        $stock = new Stock();                  
                        $stock->storeStockIngredient(array(                
                            'ingredient_id'=>$sub_value['ingredient_id'],
                            'rel_id'=>$sub_value['rel_id'],
                            'volume_product' =>  $value['volume'],
                            'suggestion'=>$sub_value['suggestion'],                        
                            'shift' =>  0, 
                            'date' =>  $today
                        ));

                        $sub_value['volume']=$stock->volume;
                        $ingredients['ing'][]=$sub_value;                        

                        //descuento by product
                        $sub_product = Product::find($sub_value['ingredient_id']);
                        $sub_product->editProductStockIngredient(array(                
                            'rel_id' =>  $sub_value['rel_id'],
                            'volume_product' =>  $value['volume'],                       
                        ));
                    }                    
                }

                //$ingredients[]=$value['ingredients'];
                
            }
            if(array_key_exists('groups',$value)){
                //el descuento del grupo esta dado en su agrupacion
                foreach ($value['groups'] as  $sub_value) {
                    if($sub_value['value'] == "true"){
                        $stock = new Stock();                  
                        $stock->storeStockIngredient(array(                
                            'ingredient_id'=>$sub_value['ingredient_id'],
                            'rel_id'=>$sub_value['rel_id'],
                            'volume_product' =>  $value['volume'],                      
                            'shift' =>  0, 
                            'date' =>  $today                        
                        ));

                        $sub_value['volume']=$stock->volume;
                        $ingredients['gru'][]=$sub_value;
                        

                        //desceunto by product
                        $sub_product = Product::find($sub_value['ingredient_id']);
                        $sub_product->editProductStockIngredient(array(                
                            'rel_id' =>  $sub_value['rel_id'],
                            'volume_product' =>  $value['volume'],                      
                        ));   
                    }                    
                }  
                //$ingredients[]=$value['groups'];             
            }

            //segundo descontamos en producto
            $product = Product::find($value['produt_id']);
            $product->editProductStock(array(                
                'volume' =>  $value['volume']                
            )); 
            
            //2.1 relacion con order products    
            $order_product = new OrderProduct();                  
            $order_product->storeOrderProduct(array(                
                'order_id'=>$obj_order->id,
                'product_id'=>$value['produt_id'],
                'ingredients' =>  json_encode($ingredients),                      
                'volume' =>  $value['volume']
            ));        
        }
                
        //notificar
        //retornar
        
        Session::flash('success', [['NewOrderTableOK']]);
        return redirect('table');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Core\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Core\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        dd($request->input());        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Core\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validamos        
        $table = Table::find($request->input('table_id'));
        $service = $table->tableServiceOpen()->first();

        if(!Auth::user()->validateUserStore($table->store_id)){
            Session::flash('danger', [['NO_STORE_OWNER']]);
            return redirect('table');
        }

        //actualizamos el estado de la orden
        $order = Order::find($request->input('order_id'));
        $order->status_id = $request->input('next_status');
        $order->save();

        Session::flash('success', [['EditOrderTableOK']]);
        return redirect('table');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Core\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
