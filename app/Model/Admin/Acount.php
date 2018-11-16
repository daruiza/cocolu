<?php

namespace App\Model\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Acount extends Model
{
    protected $fillable = ['id','name','tables','products','label','active'];

	//un rol lo pueden tener muchos usuarios
	public function users(){
		//no usa el namespace
        return $this->hasMany('App\User');
    }

    static function infoUserAcount($id){
        if(\Auth::user()->id == $id){            
            if(\Auth::user()->acount->id == 1 && \Auth::user()->rol->id == 2){
                //el usuario tiene una cuenta basica
                $message[0][0] = 'basicAcount';       
                $message[1][0] = 'descriptionBasicAcount';       
                $message[2][0] = 'canUpBasic';
                Session::flash('info', $message);
            }
        }else{
            $message[0][0] = 'errorUser';        
            $message[1][0] = 'userLogOut';
            Session::flash('danger', $message);
        }    	
    }
   
}
