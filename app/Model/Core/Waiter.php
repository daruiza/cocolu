<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Waiter extends Model
{
    protected $fillable = ['id','description','label','user_id'];
	
    public function scopeName($query,$name){
        if($name){
            return $query->where('name','LIKE',"%$name%");
        }
    }

    public function scopeSurname($query,$surname){
        if($surname){
            return $query->where('surname','LIKE',"%$surname%");
        }
    }

    public function scopeEmail($query,$email){
        if($email){
            return $query->where('email','LIKE',"%$email%");
        }
    }

    public function scopePhone($query,$phone){
        if($phone){
            return $query->where('phone','LIKE',"%$phone%");
        }
    }

    public function scopeActive($query,$active){        
        
        if(!empty($active) || $active == "0"){            
            return $query->where('active',intval($active));
        }                
    }

	//a waite is a user
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function storeWaiter($data){
        //save user        
        $user = $this->user()->first();
        $user->updateUser($data);

        if(array_key_exists('description',$data))$this->description = $data['description'];        
        $this->save();
    } 

    static function waitersByStore(){
    	return Waiter::leftjoin('users','user_id','users.id')
    		->where('users.rel_store_id',Auth::user()->store()->id)
            ->where('active',1)
            ->orderBy('users.id','ASC')
            ->get(); 
    }

    static function waitersByStoreSelect($store_id = null){

        $waiters = array();
        
        if($store_id){

            $elo_waiters =  Waiter::select('waiters.id','users.name', 'users.surname', 'waiters.user_id')
            ->leftjoin('users','user_id','users.id')
            ->where('users.rel_store_id',$store_id)
            ->where('active',1)
            ->orderBy('users.id','ASC')
            ->get()
            ->toArray();

            foreach ($elo_waiters as $key => $value) {
                $waiters[] = array(
                    'id' => $value['id'], 
                    'name' => $value['name'].' '.$value['surname'],
                    'user_id' => $value['user_id'], 
                );
            }

        }else{

            $elo_waiters =  Waiter::select('waiters.id','users.name','users.surname')
            ->leftjoin('users','user_id','users.id')
            ->where('users.rel_store_id',Auth::user()->store()->id)
            ->where('active',1)
            ->orderBy('users.id','ASC')
            ->get()
            ->toArray();
            foreach ($elo_waiters as $key => $value) {            
                $waiters[$value['id']] = $value['name'].' '.$value['surname'];
            }  
        }
        
        return $waiters;
    }
}


