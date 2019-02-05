<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Waiter extends Model
{
    protected $fillable = ['id','description','label','user_id'];
	
	//a waite is a user
    public function user(){
        return $this->belongsTo('App\User');
    }

    static function waitersByStore(){
    	return Waiter::leftjoin('users','user_id','users.id')
    		->where('users.rel_store_id',Auth::user()->store()->id)
            ->where('active',1)
            ->orderBy('users.id','ASC')
            ->get(); 
    }
}


