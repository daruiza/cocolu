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

    public function nextSerial(Service $service){
    	$order_serial = Order::select('serial')
            ->where('service_id',$service->id)
            ->max('serial');
        if(empty($order_serial)){
            $order_serial = 1;
        }else{
            $order_serial++;
        }
        return $order_serial;
    }
}
