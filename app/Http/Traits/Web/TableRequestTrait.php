<?php

namespace App\Http\Traits\Web;

use App\Model\Core\Table;
use App\Model\Core\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

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
			
		//consult the ordesr
		
		//make the totals		
		
		
		return response()->json(['return'=>true,'data'=>['request'=>$request->input(),'store_id'=>$id,'service'=>$service,'table'=>$table,'orders'=>'']]);		
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
