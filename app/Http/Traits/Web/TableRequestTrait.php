<?php

namespace App\Http\Traits\Web;

use App\Model\Core\Table;
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
            ->orderBy('id','DESC')
            ->get();
        return View::make('table.index_drag')->with('data', ['tables'=>$tables]);
    }

    public function saveDrag(Request $request,$id)
    {
        $tables = Table::
            where('store_id',Auth::user()->store()->id)
            ->where('active',1)
            ->orderBy('id','DESC')
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
                $label->position = array($value['top'],$value['right'],$value['top'],$value['left']);
                $table[0]->label = json_encode($label);
                $table[0]->save();
            }

            return View::make('table.index_drag')->with('data', ['tables'=>$tables])->with('success', [['OK']]);
        }
        
        
        return View::make('table.index_drag')->with('data', ['tables'=>$tables])->with('danger', [['NOOK']]);
        
    }
    
	
}