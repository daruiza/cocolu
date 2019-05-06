<?php

namespace App\Model\Core;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = ['id','number','name','description','logo','address','email','phone','active','store_id'];

    //a provider belongs a store    
    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function allProviders(){
        $providers = Array();
        $providers_array = \DB::table('providers')            
            ->where('store_id',Auth::user()->store()->id)
            ->orderBy('id','ASC')
            ->get();
        foreach ($providers_array as $key => $value) {            
            $providers[$value->id] = $value->number.'-'.$value->name;
        }
        return $providers;    
    }    

    public function storeProvider(Request $request){
    	
    	$this->number = explode('-',$request->input('number_provider'))[0];
    	$this->name = $request->input('name_provider');
    	$this->description = $request->input('description_provider');
    	$this->address = $request->input('adress_provider');
    	$this->email = $request->input('email_provider');
    	$this->phone = $request->input('phone_provider');        

    	if(!empty($request->file('image_provider'))){

            $this->validatorImage(['image_provider'=>$request->file('image_provider')])->validate();

            if($request->file('image_provider')->isValid()){

                $destinationPath = 'users/'.Auth::user()->id.'/providers';
                $extension = $request->file('image_provider')->getClientOriginalExtension(); // getting image extension
                $fileName_image = rand(1,9999999).'.'.$extension; // renameing image
                $request->file('image_provider')->move($destinationPath, $fileName_image);
                chmod('users/'.Auth::user()->id.'/providers/'.$fileName_image, 0777);
                
                $this->logo = $fileName_image;
            }
        }
        $this->store_id = $request->input('store-id');
    	$this->save();
    }

    public function updateProvider(Request $request){

        $this->name = $request->input('name_provider');
        $this->description = $request->input('description_provider');
        $this->address = $request->input('adress_provider');
        $this->email = $request->input('email_provider');
        $this->phone = $request->input('phone_provider');

        if(!empty($request->file('image_provider'))){

            $this->validatorImage(['image_provider'=>$request->file('image_provider')])->validate();

            if($request->file('image_provider')->isValid()){

                $destinationPath = 'users/'.Auth::user()->id.'/providers';
                $extension = $request->file('image_provider')->getClientOriginalExtension(); // getting image extension
                $fileName_image = rand(1,9999999).'.'.$extension; // renameing image
                $request->file('image_provider')->move($destinationPath, $fileName_image);
                chmod('users/'.Auth::user()->id.'/providers/'.$fileName_image, 0777);
                
                $this->logo = $fileName_image;
            }
        }

        $this->save();
    }

    protected function validatorImage(array $data)
    {        
        return Validator::make($data, [            
            'image_provider'=>'
                required|
                mimes:jpeg,bmp,png|
                dimensions:max_width=1024,max_width=1024|
                dimensions:min_width=64,min_width=64',                
        ]);
    }
}
