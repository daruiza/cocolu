<?php

namespace App\Http\Traits\Web;

use App\Model\Core\Table;
use App\Model\Core\Service;
use App\Model\Core\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Collection;

use DateTime;

trait ServiceRequestTrait
{	
	public function close(Request $request){
		//el objetivo es cambiar el estado del servicio
		$table = Table::find($request->input('table_id'));
		$tables = Table::
            where('store_id',Auth::user()->store()->id)
            ->where('active',1)
            ->orderBy('id','ASC')
            ->get();
        $orders = Order::ordersStatusOne(Auth::user()->store()->id);		
		$service = Service::
            where('table_id',$table->id)  
            ->where('open',1)            
            ->get()->first();
        
        $today = new DateTime();
        $today = $today->format('Y-m-d H:i:s');     

        $service->description = $request->input('description');
        $service->open = 0;
        $service->date_close = $today;   
        $service->save();
         return view('table.index',compact('tables','table','orders'))->with('data', [])->with('success', [['SERVICE_CLOSE_OK']]);
		
	}	
	
}