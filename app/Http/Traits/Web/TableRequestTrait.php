<?php

namespace App\Http\Traits\Web;

use App\Model\Core\Table;
use App\Model\Core\Service;
use App\Model\Core\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Collection;

trait TableRequestTrait
{
	
	public function drag($id)
    {
        $tables = Table::
            where('store_id',Auth::user()->store()->id)
            ->where('active',1)
            ->orderBy('id','ASC')
            ->get();
        //return View::make('table.index_drag')->with('data', ['tables'=>$tables]);
		return view('table.index_drag',compact('tables'))->with('data', []);
    }

    public function saveDrag(Request $request,$id)
    {   
        $tables = Table::
            where('store_id',Auth::user()->store()->id)
            ->where('active',1)
            ->orderBy('id','ASC')
            ->get();        
        //validamos que la tienda sea del usuario
        if(Auth::user()->validateUserStore($id)){
            $json_tables = json_decode($request->input('data'),true);
            foreach($json_tables as $value){
                //actualizamos tabla por tabla                
                $table = Table::where('store_id',Auth::user()->store()->id)
                    ->where('id',$value['id'])
                    ->where('active',1)                    
                    ->get();                    
                $label = json_decode($table[0]->label);
                $label->position = array($value['top'],$value['right'],$value['bottom'],$value['left']);
                $table[0]->label = json_encode($label);
                $table[0]->save();
            }

            $tables = Table::
            where('store_id',Auth::user()->store()->id)
            ->where('active',1)
            ->orderBy('id','ASC')
            ->get();

            //return View::make('table.index')->with('data', ['tables'=>$tables])->with('success', [['OK']]);
			return view('table.index',compact('tables'))->with('data', [])->with('success', [['OK']]);
        }       
        
        //return View::make('table.index_drag')->with('data', ['tables'=>$tables])->with('danger', [['NOOK']]);		
		return view('table.index_drag',compact('tables'))->with('data', []);
        
    }
	
    //al dar click sobre una mesa
	public function selectService(Request $request,$id){
		//validate ouner store		
		if(!Auth::user()->validateUserStore($id)){
			return response()->json(['return'=>false,'data'=>null]);
		}	
		
		//consult the table		
		$table = Table::where('store_id',$id)
			->where('id',$request->input('table_id'))
			->where('active',1)                    
			->get();

		//consult service, en caso de tener
        $service = Service::where('table_id',$request->input('table_id'))            
            ->where('open',1)
            ->get();
			
		//consult the orders, con mesero, estado y productos
        $orders = collect();    
        if($service->count()){
            $orders = Order::select('orders.*','users.name as waiter','order_status.name as status'
                ,\DB::raw('SUM(products.price*order_product.volume) as order_price'))
                ->leftJoin('waiters','waiters.id','orders.waiter_id')
                ->leftJoin('users','users.id','waiters.user_id')                
                ->leftJoin('order_status','order_status.id','orders.status_id')
                ->leftJoin('order_product','order_product.order_id','orders.id')
                ->leftJoin('products','products.id','order_product.product_id')
                ->where('service_id',$service->first()->id)
                ->where(function($query){
                     $query->where('status_id',1)//orden tomada
                     ->orWhere('status_id',2)//orden lista para entregar
                     ->orWhere('status_id',3);//orden paga
                    //->orWhere('status',4)//orden cerrada
                 })
                ->groupBy('orders.id')
                ->get();    
        }		
		
		return response()->json(['return'=>true,'data'=>['request'=>$request->input(),'store_id'=>$id,'service'=>$service,'table'=>$table,'orders'=>$orders]]);		
	}
	
	public function service(Request $request,$id){		
		return $this->serviceController->create($request);		
	}
	
	public function saveService(Request $request,$id){        
		return $this->serviceController->store($request);
	}

    public function saveOrder(Request $request,$id){        
        return $this->orderController->store($request);
    }
    
	
}
