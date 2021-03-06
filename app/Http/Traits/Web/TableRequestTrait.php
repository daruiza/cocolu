<?php

namespace App\Http\Traits\Web;

use App\Model\Core\Table;
use App\Model\Core\Store;
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
                    ->orWhere('status_id',3)//orden paga
                    ->orWhere('status_id',4);//orden cerrada
                 })
                // ->where('order_product.status_paid',false)
                ->groupBy('orders.id')
                ->orderBy('orders.status_id','ASC')
                ->get();    
        }
        //order_product	
        $order_products = array();
        foreach ($orders as $key => $value) {
            $order_products[$value->id]=$value->orderProducts();
        }
		
		return response()->json(['return'=>true,'data'=>['request'=>$request->input(),'store_id'=>$id,'service'=>$service,'table'=>$table,'orders'=>$orders,'order_product'=>$order_products]]);		
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

    public function closeService(Request $request,$id){        
        return $this->serviceController->close($request);
    }

    public function qrcode(Request $request,$id){        
        $store = Store::findOrFail($request->input('store-id'));        
        $table = Table::where('id',$request->input('table-id'))->where('store_id',$store->id)->first();
        /*esto es para almacenar la imagen en public
        \QrCode::
        size(350)->errorCorrection('H')        
        ->format('png')
        ->generate(route('message.request',[$store->id,$table->id]),'../public/qrcodes/qrcode.png'); 
        */
        
        
        //return view('table.generate_qr',compact('store','table'))->render();
        
        $view = view::make('table.generate_qr',compact('store','table'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //return $pdf->stream('QR'.$store->name.'-'.$table->name);

        //$pdf = \PDF::loadView('table.generate_qr',compact('store','table'));
        //return $pdf->stream('hello.pdf');         
        return $pdf->download('QR'.$store->name.'-'.$table->name);
    }
	
}
