<?php

namespace App\Http\Traits\Web;

use App\Model\Core\Store;
use App\Model\Core\Table;
use App\Model\Core\Message;

use App\Events\NewRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

trait MessageRequestTrait
{	
	public function request($id_store, $id_table, Request $request){
		//validamos los datos
		//1 existencia de la tienda		
		$store = Store::findOrFail($id_store);
		$table = Table::findOrFail($id_table)->where('store_id',$id_store)->first();
		
		//request
		$request = array('');

		if(app()->getLocale()=="es")$request = 
			array(
				'Una Cansión'=>'Una Cansión',					
				'La Cuenta'=>'La Cuenta',
				'Una Sugerencia'=>'Una Sugerencia',
				'Una Queja'=>'Una Queja'
			);

		if(app()->getLocale()=="en")$request =
			array(
				'A Song'=>'A Song',				
				'The Bill'=>'The Bill',
				'A Suggestion'=>'A Suggestion',
				'A Somplaint'=>'A Complaint'
			);

        return view('message.request_store',compact('store','table','request'));
    }

    public function requestStore(Request $request){    	
    	
    	$store = Store::findOrFail($request->input('store_id'));
    	$table = Table::
    		findOrFail($request->input('table_id'))
    		->where('store_id',$request->input('store_id'))
    		->first();

    	$message = new Message();          
        $message->issue = $request->input('issue');
        $message->body = $request->input('body');
        $message->rel_store_id = $request->input('store_id');        
        $message->save();

        //guardamos el mensaje
                
        //enviamos la notificación        
        broadcast(new NewRequest($table,$message))->toOthers();        

        $message = Message::find($message->id);  
        $message->delete();        

        Session::flash('guest_success', [['MessageSendOk']]);
        return redirect()->route('message.request',['id_store'=>$request->input('store_id'),'id_table'=>$request->input('table_id')]);
        

    }

}