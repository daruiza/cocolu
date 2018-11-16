<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['id','name','department','city','adress','description','logo','currency','label','active'];

    //una tienda puede tener muchas mesas
    public function tables(){
        //no usa el namespace
        return $this->hasMany(Table::class);
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
