<?php

namespace App\Http\Traits\Web;

use App\Model\Core\Clousure;
use Illuminate\Http\Request;
use App\Model\Exports\ClousureExports;
//use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Auth;

trait ClousureRequestTrait
{
	
	public function showClousures(Request $request, $id){

		$inputs = $request->input();        
        if(empty($inputs['name']))$inputs['name']=null;    
        if(empty($inputs['description']))$inputs['description']=null;
        if(empty($inputs['date_open']))$inputs['date_open']=null;
        
        $name = $request->get('name');
        $description = $request->get('description');
        $date_open = $request->get('date_open');

        $clousures = Clousure::
        	select('clousures.*',
        	\DB::raw('SUM(products.price * order_product.volume) as total')
        	)
        	->leftJoin('services','clousures.id','services.rel_clousure_id')        
        	->leftJoin('orders','services.id','orders.service_id')        
        	->leftJoin('order_product','orders.id','order_product.order_id')
        	->leftJoin('products','order_product.product_id','products.id')
	        ->where('clousures.open',0)
            ->where('orders.status_id',3)
	        ->where('clousures.store_id',Auth::user()->store()->id)
	        ->orderBy('clousures.id','DESC')
	        ->groupBy('clousures.id')	        
            ->name($name)
            ->description($description)
            ->date_open($date_open)
            ->paginate(10);                    
	        
        return redirect('/')->with('data',['clousures'=>$clousures,'inputs'=>$inputs]);
    }

	public function consultClousure(Request $request){	
        //$home = new HomeController;
        //return $home->index(Clousure::find($request->input('clousure-id')));
		return  app('App\Http\Controllers\HomeController')->index(Clousure::find($request->input('clousure-id')));
		
	}

    public function toExcel(Request $request,$id){
        /*
        $data = Clousure::all();        
        \Excel::create('ReporteCierreExcel',function($excel) use ($data){
            $excel->sheet('Sheet 1',function($sheet) use ($data){
                $sheet->fromArray($export);
            });
        })->download('xlsx');
        */

        return \Excel::download(new ClousureExports, 'users.xlsx');

    }	
	
}