<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;
use App\Model\Core\Service;
use App\Model\Core\Clousure;

class Order extends Model
{
	protected $fillable = ['id','serial','description','date','active','status_id','waiter_id','service_id'];	
    
    public function products(){
        //reutiliza el namespace
        return $this->belongsToMany(Product::class);
    }

    public function service(){
        //reutiliza el namespace
        return $this->belongsTo(Service::class);
    }

    public function waiter(){
        //reutiliza el namespace
        return $this->belongsTo(Waiter::class);
    }

    public function status(){
        //reutiliza el namespace
        return $this->belongsTo(OrderStatus::class);
    }

    public function orderProducts(){
        return json_encode(Order::select(
                        'order_product.id',
                        'order_product.status_serve',
                        'order_product.status_paid',
                        'order_product.order_id',
                        'order_product.product_id'
                    )
                    ->leftJoin('order_product','orders.id','order_product.order_id')
                    ->where('orders.id',$this->id)
                    ->get()->toArray());
    }

    public function nextSerial(Service $service){
    	$order_serial = Order::select('serial')
            ->leftJoin('services','orders.service_id','services.id')
            ->leftJoin('clousures','services.rel_clousure_id','clousures.id')
            ->where('clousures.id',$service->rel_clousure_id)
            ->max('serial');
        if(empty($order_serial)){
            $order_serial = 1;
        }else{
            $order_serial++;
        }
        return $order_serial;
    }

    static function ordersStatusOne($store_id){
        $orders = Order::select('orders.*')
        ->leftJoin('services','orders.service_id','services.id')
        ->leftJoin('clousures','services.rel_clousure_id','clousures.id')
        ->where('clousures.store_id',$store_id)
        ->where('clousures.open',1)
        ->where('orders.status_id',1)
        ->orderBy('id','ASC')
        ->get();  
        return $orders;    
    }


    static function ordersStatusOneServiceGet($store_id, $service_id){
        return Order::select('orders.*')
        ->leftJoin('services','orders.service_id','services.id')
        ->leftJoin('clousures','services.rel_clousure_id','clousures.id')
        ->where('clousures.store_id',$store_id)
        ->where('orders.service_id',$service_id)
        ->where('clousures.open',1)
        ->where('orders.status_id',1)
        ->orderBy('id','ASC');
    }

    static function ordersStatusOneService($store_id, $service_id){
        return Order::ordersStatusOneServiceGet($store_id, $service_id)->get();
    }

    static function ordersStatusOneServicePaid($store_id, $service_id){
        return Order::ordersStatusOneServiceGet($store_id, $service_id)
        ->update(['status_id' => 3]);
    }

    static function orderProductStatusOneServicePaid($store_id, $service_id){
        return Order::
        ordersStatusOneServiceGet($store_id, $service_id)
        ->select('orders.*', 'order_product.status_paid')
        ->leftJoin('order_product','order_product.order_id','orders.id')
        ->update(['status_paid' => 1]);
    }



    public function orderPrice(){
        $order = Order::
        select(\DB::raw('SUM(products.price*order_product.volume) as order_price'))
            ->leftJoin('order_product','order_product.order_id','orders.id')
            ->leftJoin('products','products.id','order_product.product_id')
            ->where('orders.id',$this->id)               
            ->groupBy('orders.id')
            ->get();
                    
        return $order->first()->order_price;
    }

    //retorna un array asociativo con los estados de las ordes vigentes y su cantida
    static function orderStatus(Clousure $clousure, $array, $array_border){        
        $orders_array = array();
        $orders_array['labels'] = array();
        $orders_array['data'] = array();
        $orders_array['backgroundColor'] = array();
        $orders_array['borderColor'] = array();

        $orders = Order::select('orders.*','order_status.name as status',\DB::raw('count(*) as total'))
        ->leftJoin('services','orders.service_id','services.id')
        ->leftJoin('clousures','services.rel_clousure_id','clousures.id')
        ->leftJoin('order_status','orders.status_id','order_status.id')
        ->where('clousures.id',$clousure->id)
        ->groupBy('status_id')
        ->get()->toArray();

        //armamos el array        
        foreach ($orders as $key => $order) {            
            if(!in_array($order['status'],$orders_array['labels'])){
                $orders_array['labels'][] = __('messages.'.$order['status']);                    
                $orders_array['data'][] = $order['total'];
                $orders_array['backgroundColor'][] = $array[$order['status']];
                $orders_array['borderColor'][] = $array_border[$order['status']];
            }
        }        
        return $orders_array;
    }

    //$$$$ plata en caja
    static function ordersPaid(Clousure $clousure){
        
        //consultamos las ordenes pagas
        $orders = Order::select(            
            \DB::raw('SUM(products.price * order_product.volume) as total')
        )
        ->leftJoin('services','orders.service_id','services.id')
        ->leftJoin('clousures','services.rel_clousure_id','clousures.id')        
        ->leftJoin('order_product','orders.id','order_product.order_id')
        ->leftJoin('products','order_product.product_id','products.id') 
        ->where('clousures.id',$clousure->id)
        ->where('orders.status_id',3)        
        ->get();        
        return $orders->first()->total;
    }

    //$$$$ plata por pagar
    static function orderToPay(Clousure $clousure){
        //consultamos las ordenes pagas
        $orders = Order::select(            
            \DB::raw('SUM(products.price * order_product.volume) as total')
        )
        ->leftJoin('services','orders.service_id','services.id')
        ->leftJoin('clousures','services.rel_clousure_id','clousures.id')        
        ->leftJoin('order_product','orders.id','order_product.order_id')
        ->leftJoin('products','order_product.product_id','products.id') 
        ->where('clousures.id',$clousure->id)
        ->where('orders.status_id',2)        
        ->get();        
        return $orders->first()->total;
    }

    //conteo  ordenes despachadas
    static function ordersClousure(Clousure $clousure){
        //consultamos las ordenes pagas
        $orders = Order::select('orders.*')
        ->leftJoin('services','orders.service_id','services.id')
        ->leftJoin('clousures','services.rel_clousure_id','clousures.id')                
        ->where('clousures.id',$clousure->id)        
        ->where(function($query){
            $query->where('orders.status_id',1)//orden tomada
            ->orWhere('orders.status_id',2)//orden lista para entregar
            ->orWhere('orders.status_id',3)
            ->orWhere('orders.status_id',4);
        })        
        ->get();        
        return $orders->count();
    }

    //ordenes canceladas
    static function ordersCancelClousure(Clousure $clousure){
        //consultamos las ordenes pagas
        $orders = Order::select('orders.*')
        ->leftJoin('services','orders.service_id','services.id')
        ->leftJoin('clousures','services.rel_clousure_id','clousures.id')                
        ->where('clousures.id',$clousure->id)
        ->where('orders.status_id',4)        
        ->get();        
        return $orders->count();
    }
}
