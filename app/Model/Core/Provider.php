<?php

namespace App\Model\Core;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = ['id','number','name','description','logo','address','email','phone','active','store_id'];

    //a provider belongs a store    
    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function storeProvider(Request $request){
    	
    	$this->number = $request->input('number_provider');
    	$this->name = $request->input('name_provider');
    	$this->description = $request->input('description_provider');
    	$this->address = $request->input('adress_provider');
    	$this->email = $request->input('email_provider');
    	$this->phone = $request->input('phone_provider');

    	if(!empty($request->file('img_provider'))){

            $this->validatorImage(['img_provider'=>$request->file('img_provider')])->validate();

            if($request->file('img_provider')->isValid()){

                $destinationPath = 'users/'.Auth::user()->id.'/providers';
                $extension = $request->file('img_provider')->getClientOriginalExtension(); // getting image extension
                $fileName_image = rand(1,9999999).'.'.$extension; // renameing image
                $request->file('img_provider')->move($destinationPath, $fileName_image);
                chmod('users/'.Auth::user()->id.'/providers/'.$fileName_image, 0777);
                
                $this->logo = $fileName_image;
            }
        }

    	$this->save();
    }

    protected function validatorImage(array $data)
    {        
        return Validator::make($data, [            
            'img_provider'=>'
                required|
                mimes:jpeg,bmp,png|
                dimensions:max_width=1024,max_width=1024|
                dimensions:min_width=64,min_width=64',                
        ]);
    }
}
