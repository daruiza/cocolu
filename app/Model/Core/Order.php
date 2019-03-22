<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;
use App\Model\Core\Service;

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
}
