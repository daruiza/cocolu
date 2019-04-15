<?php

namespace App;

use App\Model\Core\Store;
use App\Model\Core\Clousure;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','surname', 'email', 'phone','avatar', 'password','active','rol_id','rel_store_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];    

    //un usuario posee/pertenece un rol
    public function rol(){
        return $this->belongsTo(Model\Admin\Rol::class);
    }

    //un usuario posee una cuenta
    public function acount(){
        return $this->belongsTo(Model\Admin\Acount::class);
    }
	
	//a user may belongs a waiter
    public function waiter(){
        return $this->belongsTo(Model\Core\Waiter::class);
    }
    
    /*
    *
    *funciones propias
    *
    */
    public function rol_options(){
        return json_decode(\Auth::user()->rol->label,true)['options'];        
    }

    public function rol_options_dashboard(){
        return json_decode(\Auth::user()->rol->label,true)['options_dashboard'];        
    }

    public function edit($id){
        //verificación de usuario.
        if( \Auth::user()->id == $id) return true;
        return false;        
    }

    public function validateUser(){        
        //verificación de usuario.
        if( \Auth::user()->id == $this->id) return true;
        return false;        
    }

    public function validateUserStore($store_id){        
        if(User::where('users.rel_store_id',$store_id)
            //->where('users.rol_id',2)
            ->get()
            ->toArray()[0]['id'] == \Auth::user()->id
        ) return true;
        return false;
    }

    public function updateUser($data){
        //guardamos los datos
        $this->name = $data['name'];
        $this->surname = $data['surname'];
        $this->phone = $data['phone'];
        $this->email = $data['email'];
        //FALTA ingresamos a imagen...
        if(!empty($data['image'])){
            if($data['image']->isValid()){                      
                $destinationPath = 'users/'.$this->id.'/profile';
                $extension = $data['image']->getClientOriginalExtension(); // getting image extension
                $fileName_image = rand(1,9999999).'.'.$extension; // renameing image
                $data['image']->move($destinationPath, $fileName_image);                        
            }            
            $this->avatar = $fileName_image;            
        }
        $this->save();         

        return $this;
    }
	
	//this method consult a store user
    public function store(){
        return Store::where('id', $this->rel_store_id)->firstOrFail();//consultamos la tienda
    } 

    //crea el primer clouure para iniciar la labor
    public function clousureInit($user_id){
        //$user = User::where('id', $user_id);        
        return Clousure::create([
            'name' => 'Clousure Init',
            'description' => 'Default Clousure Init',
            'open' => true,
            'store_id' => $this->rel_store_id,
        ]);
    }

    //crea el directorio del usuario, para el registro de tenderos
    public function repository($user_id){
        //verificacion de existencia de directorio
        if (is_dir('users/'.$user_id)){
            return false;
        }
        if(!mkdir('users/'.$user_id.'/profile',0777,true)){
            return false;
        }
        chmod('users/'.$user_id, 0777);
        if (!copy('images/user/default.png', 'users/'.$user_id.'/profile/default.png')) {
           return false;
        }
        chmod('users/'.$user_id.'/profile/default.png', 0777);

        if(!mkdir('users/'.$user_id.'/stores',0777,true)){
            return false;                                   
        }                               
        chmod('users/'.$user_id, 0777);

        //ubicamos la imagen de la tienda de usuario, necesaria para que se cree el directorio
        if (!copy('images/store/default.png', 'users/'.$user_id.'/stores/default.png')) {
            return false;    
        }
        chmod('users/'.$user_id.'/stores/default.png', 0777);

        if(!mkdir('users/'.$user_id.'/products',0777,true)){
            return false;                                    
        }                               
        chmod('users/'.$user_id, 0777);

        //ubicamos la imagen del producto por defecto
        if (!copy('images/product/default.png', 'users/'.$user_id.'/products/default.png')) {
           return false;  
        }
        chmod('users/'.$user_id.'/products/default.png', 0777);

        if(!mkdir('users/'.$user_id.'/supports',0777,true)){
            return false;                                    
        }                               
        chmod('users/'.$user_id, 0777);

        //ubicamos la imagen del producto por defecto
        if (!copy('images/supports/default.png', 'users/'.$user_id.'/supports/default.png')) {
           return false;  
        }
        chmod('users/'.$user_id.'/supports/default.png', 0777);

        return true;
    }
	
	function repositoryWaiter($user_id){
		//verificacion de existencia de directorio
        if (is_dir('users/'.$user_id)){
            return false;
        }
        if(!mkdir('users/'.$user_id.'/profile',0777,true)){
            return false;
        }
        chmod('users/'.$user_id, 0777);
        if (!copy('images/user/default.png', 'users/'.$user_id.'/profile/default.png')) {
           return false;
        }
        chmod('users/'.$user_id.'/profile/default.png', 0777);
		
		return true;
	}

    //asignacion de permisos en session
    public function permits(){
        $permits = array();        
        foreach(Auth::user()->rol()->get()[0]->options()->get() as $key => $option) {
            if(!array_key_exists($option->module()->get()[0]->name, $permits))$permits[$option->module()->get()[0]->name]=$option->module()->get()[0]->toArray();
            $permits[$option->module()->get()[0]->name]['options'][$option->id]=$option->toArray();
        }        
        Session::put('permits', $permits);
    }

    //asignacion de permisos en session
    public function userPermits($user_id){
        $user = User::find($user_id);
        $permits = array();                
        foreach($user->rol()->get()[0]->options()->get() as $key => $option) {
            if(!array_key_exists($option->module()->get()[0]->name, $permits))$permits[$option->module()->get()[0]->name]=$option->module()->get()[0]->toArray();
            $permits[$option->module()->get()[0]->name]['options'][$option->id]=$option->toArray();
        }        
        Session::put('permits', $permits);
    }

}
