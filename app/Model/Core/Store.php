<?php

namespace App\Model\Core;

use App\Model\Core\Clousure;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['id','name','department','city','adress','description','logo','currency','label','active'];

    //una tienda puede tener muchas mesas
    public function tables(){
        //no usa el namespace
        return $this->hasMany(Table::class);
    }

    //una tienda puede tener muchos productos
    public function products(){
        //no usa el namespace
        return $this->hasMany(Product::class);
    }
    
    //a table may be a many cousures
    public function clousures(){
        //no usa el namespace
        return $this->hasMany(Clousure::class);
    }

    //una tienda puede tener muchos proveedores
    public function providers(){
        //no usa el namespace
        return $this->hasMany(Provider::class);
    }

    //una tienda puede tener muchos proveedores
    public function invoices(){
        //no usa el namespace
        return $this->hasMany(Invoice::class);
    }

    //consulta todos los proveedores de la tienda
    public function allProvider(){
        $array = array();
        foreach(Auth::user()->store()->first()->providers()->get() as $key => $value){
            $array[] = $value->name;
        }
        return $array;
    }

    public function clousureOpen(){
        $clousure = Clousure::where('open',1)->where('store_id',Auth::user()->store()->id)->get()->first();
        return $clousure;
    }

    public function updateStore($data){
        //guardamos los datos
        $this->name = $data['name'];
        $this->department = $data['department'];
        $this->city = $data['city'];
        $this->adress = $data['adress'];
        $this->description = $data['description'];
        $this->adress = $data['adress'];
        $this->currency = $data['currency'];
        if(!empty($data['label']))$this->label = $data['label'];
        //FALTA ingresamos a imagen...
        if(!empty($data['image'])){
            if($data['image']->isValid()){                      
                $destinationPath = 'users/'.\Auth::user()->id.'/stores';
                $extension = $data['image']->getClientOriginalExtension(); // getting image extension
                $fileName_image = rand(1,9999999).'.'.$extension; // renameing image
                $data['image']->move($destinationPath, $fileName_image);                        
            }            
            $this->logo = $fileName_image;
            
        }
        
        //label        
        $label = json_decode($this->label);        
        if(!empty($data["storeheight"])){
            $label->table->StoreHeight = $data["storeheight"];            
        } 
        if(!empty($data["tableheight"])){
            $label->table->TableHeight = $data["tableheight"];            
        } 
        if(!empty($data["selecttable"])){
            $label->table->selectTable = $data["selecttable"];          
        } 
        if(!empty($data["serviceopentable"])){
            $label->table->serviceOpenTable = $data["serviceopentable"];          
        } 
        if(!empty($data["colorrow"])){
            $label->table->colorRow = $data["colorrow"];            
        }
        if(!empty($data["colorinactive"])){
            $label->table->colorInactive = $data["colorinactive"];          
        } 

        if(!empty($data["ordernew"])){
            $label->order->OrderNew = $data["ordernew"];            
        } 
        if(!empty($data["orderok"])){
            $label->order->OrderOK = $data["orderok"];            
        } 
        if(!empty($data["orderpay"])){
            $label->order->OrderPay = $data["orderpay"];
            
        }
        if(!empty($data["ordercancel"])){
            $label->order->OrderCancel = $data["ordercancel"];             
        }
        
        $this->label = json_encode($label);

        $this->save();
        
        $this->storeheight = $data["storeheight"];
        $this->tableheight = $data["tableheight"];
        $this->selecttable = $data["selecttable"];
        $this->serviceopentable = $data["serviceopentable"];
        $this->colorrow = $data["colorrow"];
        $this->colorinactive = $data["colorinactive"];
        $this->ordernew = $data["ordernew"];
        $this->orderok = $data["orderok"];
        $this->orderpay = $data["orderpay"];
        $this->ordercancel = $data["ordercancel"];         
        
        return $this;
    }

}
