<?php

namespace App\Model\Core;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['id','number','description','support','tax','provider_id','store_id','clousure_id'];

    public function scopeNumber($query,$number){
        if($number){
            return $query->where('number','LIKE',"%$number%");
        }
    }

    public function scopeDate($query,$date){
        if($date){
            //si solo fecha de año y mes
            //1. año - mes
            if(count(explode('-',$date)) == 2){
                if(strlen($date) == 6 || strlen($date) == 7){                    

                    $aux_date = $date.'-01 00:00:00';                    
                    $result = strtotime($aux_date);
                    $result = strtotime('-1 second', strtotime('+1 month', $result));
                    
                    return $query
                        ->whereBetween('invoices.created_at',[
                            $aux_date,
                            date('Y-m-d', $result)
                        ]);
                }
            }
            return $query
                ->whereBetween('invoices.created_at',[
                    "$date".' 00:00:00',
                    "$date".' 23:59:59'
                ]);
        }
    }

    public function scopeClousure($query,$clousure){
        if(count(explode('-',$clousure)) == 2){
            $date = new DateTime($clousure.'.-01');
            $date->modify('+1 month');
            $date->modify('-1 day');            
            return $query                
                ->whereBetween('clousures.date_open',[
                    $clousure."-01".'01 00:00:00',
                    $date->format('Y-m-d').' 23:59:59'
                ]);   
        }        
        if($clousure){            
            return $query                
                ->whereBetween('clousures.date_open',[
                    "$clousure".' 00:00:00',
                    "$clousure".' 23:59:59'
                ]);   
        }
    }

    public function scopeProvider($query,$provider){
        if($provider){
            return $query
                ->select('invoices.*')
                ->leftJoin('providers','providers.id','invoices.provider_id')
                ->where('providers.name','LIKE',"%$provider%");
        }
    }

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
        //->leftJoin('invoice_product','products.id','invoice_product.product_id');
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
