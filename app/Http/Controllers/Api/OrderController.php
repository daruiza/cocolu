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

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Orders by service para la consulta de una mesa dada su servicio
    public function index(Request $request){
        //Obtiene las ordenes con sus order_product
        $order_product = OrderProduct::select(
            'orders.id',
            'orders.status_id',
            'orders.description',
            'orders.date',
            'order_product.id as order_product_id',
            'order_product.product_id as product_id',
            'order_product.status_paid',
            'order_product.volume',
            'order_product.price',
            'products.name'
        )
            ->leftJoin('orders', 'order_product.order_id', 'orders.id')
            ->leftJoin('products', 'order_product.product_id', 'products.id')
            ->leftJoin('services', 'orders.service_id', 'services.id')
            ->where(function ($q) {
                $q->where('orders.status_id', 1)
                    ->orWhere('orders.status_id', 2)
                    ->orWhere('orders.status_id', 3)
                    ->orWhere('orders.status_id', 4);
            })
            ->where('services.open', 1)
            ->where('services.table_id', $request->input('table')['id'])
            ->orderBy('id', 'DESC')
            ->get();
        return response()->json($order_product);
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

        $cousure = Clousure::where('store_id', $request->user()['rel_store_id'])
            ->where('open', 1)
            ->get();

        if ($cousure->count() <> 1) {
            return response()->json(['message' => 'NO_ONLYONE_CLOUSURE'], 404);
        }

        $products = $request->input('order')['products'];
        if (!count($products)) {
            return response()->json(['message' => 'NO_ORDER_SAVE'], 404);
        }

        $order_product_res = array();
        $obj_res = array(
            'table' => $request->input('table'),
            'service' => $request->input('service'),
            'order_form' => array(
                'user' => $request->input('order')['user'],
                'waiter' => $request->input('order')['waiter']
            ),
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
            if ($product->buy_price) {
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
                    'description' => 'sold',
                    'date' =>  $today
                ));
            }

            // Los Ingredientes
            $ingredients = $product->ingredients();
            if (count($ingredients)) {
                foreach ($ingredients as $key_ingredient => $value_ingredient) {
                    // descuento de ingrediente en stock
                    if (!$value_ingredient->group) {

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
                            'description' => 'sold',
                            'date' =>  $today
                        ));
                    }
                }
            }

            //2.1 relacion con order products
            $order_product = new OrderProduct();
            $order_product->storeOrderProduct(array(
                'order_id' => $obj_order->id,
                'product_id' => $value_product['id'],
                'ingredients' =>  json_encode($ingredients),
                'volume' =>  1,
                'price' => $value_product['price']
            ));

            // respuesta order_product
            $order_product_res[] = array(
                'id' => $obj_order->id,
                'poduct_id' => $value_product['id'],
                'order_product_id' => $order_product->id,
                'date' => $obj_order->date,
                'description' => $obj_order->description,
                'name' => $value_product['name'],
                'price' => $value_product['price'],
                'status_id' => 1,
                'status_paid' => 0
            );
            $obj_res['total'] = $obj_res['total'] + $value_product['price'];
        }
        $obj_res['order'] = array(
            'id' => $obj_order->id,
            'description' => $obj_order->description,
            'date' => $obj_order->date,
            'status_id' => 1,
            'orders' => $order_product_res,
        );
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
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }

    // Para consultar los productos para realizar una orden
    public function products(Request $request)
    {

        $waiters = Waiter::waitersByStoreSelect($request->user()->rel_store_id);
        $products = Product::productstByStore($request->user()->rel_store_id);
        $categories = array();

        foreach ($products as $value) {
            if (!in_array($value->category, $categories)) {
                $categories[] = $value->category;
            };
        }

        return response()->json([
            'products' => $products,
            'categories' => $categories,
            'waiters' => $waiters
        ]);
    }

    public function statusOrder(Request $request)
    {
        $status_id = intval($request->input('idStatus'));
        $statusPaid = $status_id === 3 ? 1 : 0;
        $order = Order::find($request->input('idOrder'));
        $order_product = OrderProduct::where('order_id', $order->id)
            ->update(['status_paid' => $statusPaid]);
        $order->status_id = $status_id;
        $order->save();
        return response()->json($order_product);
    }

    public function cancelOrder(Request $request)
    {
        $oder = Order::find($request->input('idOrder'))->delete();
        return response()->json($oder);
    }

    public function statusPayProduct(Request $request)
    {
        $statusPaid = intval($request->input('statusPaid')) ? 0 : 1;
        $order = Order::find($request->input('idOrder'));
        $order_product = OrderProduct::where('id', $request->input('idOrderProduct'))
            ->where('order_id', $order->id)
            ->update(['status_paid' => $statusPaid]);

        // Verificamos si todos los product_orders
        // estan pagos para pagar la orden
        $order_products = OrderProduct::where('order_id', $order->id)
            ->where('status_paid', '0')
            ->get();

        if (!count($order_products)) {
            $order->status_id = 3;
            $order->save();
        }

        return response()->json($order_product);
    }

    public function cancelProduct(Request $request)
    {
        $cousure = Clousure::where('store_id', $request->user()['rel_store_id'])->where('open', 1)->get();
        $order_product = OrderProduct::find($request->input('idOrderProduct'));
        $product = Product::find($order_product->product_id);
        $today = new DateTime();
        $today = $today->format('Y-m-d H:i:s');

        // Restaurar Producto
        $product->editProductStock(array('volume' =>  1), true);
        // restaurar el stock
        $stock = new Stock();
        $stock->storeStockProduct(array(
            'product_id' =>  $order_product->product_id,
            'volume' =>  1,
            'shift' =>  1,
            'rel_clousure_id' => $cousure->first()->id,
            'description' => 'sold',
            'date' =>  $today
        ));

        // Eliminar Orden de producto
        $order_product = OrderProduct::find($request->input('idOrderProduct'))->delete();

        // Eliminar la orden si no le quedan productos
        $order_products = OrderProduct::where('order_id', $request->input('idOrder'))->get();
        if (!count($order_products)) {
            Order::find($request->input('idOrder'))->delete();
        }
        return response()->json($order_product);
    }

    public function cancelOrders(Request $request)
    {
        $oders = Order::where('service_id', $request->input('idService'))->delete();
        return response()->json($oders);
    }

    public function payOrders(Request $request)
    {
        $oders = Order::where('service_id', $request->input('idService'))->get();
        foreach ($oders as $order) {
            OrderProduct::where('order_id', $order->id)->update(['status_paid' => 1]);
            $order->status_id = 3;
            $order->save();
        }
        return response()->json($oders);
    }
}
