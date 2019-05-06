<?php

namespace App\Model\Core;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['id','number','description','support','tax','provider_id','store_id','clousure_id'];

    //a invoice belongs a store    
    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function clousure(){
        return $this->belongsTo(Clousure::class);
    }

    public function products(){
        //no usa el namespace
        return $this->hasMany(InvoiceProduct::class);
        //return $this->belongsToMany(Product::class);
    }

    public function provider(){
        return $this->belongsTo(Provider::class);
    }

    public function storeInvoice(Request $request, $provider_id){

    	$this->number = $request->input('number_invoice');
    	$this->description = $request->input('description_invoice');
    	$this->tax = $request->input('tax_invoice');

    	//validamos la imagen
        if(!empty($request->file('image_suport'))){

            $this->validatorImage(['image_suport'=>$request->file('image_suport')])->validate();

            if($request->file('image_suport')->isValid()){

                $destinationPath = 'users/'.Auth::user()->id.'/supports';
                $extension = $request->file('image_suport')->getClientOriginalExtension(); // getting image extension
                $fileName_image = rand(1,9999999).'.'.$extension; // renameing image
                $request->file('image_suport')->move($destinationPath, $fileName_image);
                chmod('users/'.Auth::user()->id.'/supports/'.$fileName_image, 0777);
                
                $this->support = $fileName_image;
            }
        }

        $this->store_id = $request->input('store-id');
        $this->provider_id = $provider_id;
        $this->clousure_id = Auth::user()->store()->clousureOpen()->id;     
    	$this->save();

	}

	public function updateInvoice(Request $request){

        $this->number = $request->input('number_invoice');
    	$this->description = $request->input('description_invoice');
    	$this->tax = $request->input('tax_invoice');

    	//validamos la imagen
        if(!empty($request->file('image_suport'))){

            $this->validatorImage(['image_suport'=>$request->file('image_suport')])->validate();

            if($request->file('image_suport')->isValid()){

                $destinationPath = 'users/'.Auth::user()->id.'/providers';
                $extension = $request->file('image_suport')->getClientOriginalExtension(); // getting image extension
                $fileName_image = rand(1,9999999).'.'.$extension; // renameing image
                $request->file('image_suport')->move($destinationPath, $fileName_image);
                chmod('users/'.Auth::user()->id.'/providers/'.$fileName_image, 0777);
                
                $this->support = $fileName_image;
            }
        }
        
    	$this->save();
    }

    public function invoicePrice(){
        //total de invoice
        return \DB::table('invoice_product')           
            ->where('invoice_id',$this->id)            
            ->orderBy('id','ASC')
            ->groupBy('invoice_id')
            ->sum('price');
            
    }

    protected function validatorImage(array $data)
    {        
        return Validator::make($data, [            
            'image_suport'=>'
                required|
                mimes:jpeg,bmp,png|
                dimensions:max_width=1024,max_width=1024|
                dimensions:min_width=64,min_width=64',                
        ]);
    }
}
