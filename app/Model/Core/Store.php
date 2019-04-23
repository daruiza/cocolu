<?php

namespace App\Model\Core;

use App\Model\Core\Clousure;

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

    public function clousureOpen(){
        $clousure = Clousure::where('open',1)->get()->first();
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
        $this->save();         

        return $this;
    }

}
