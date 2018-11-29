<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = ['id','name','description','icon','label','order','active','store_id'];

    //una mesa pertenece a una tienda
    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function icons()
    {
        return [
            'fas fa-beer' =>'mesaggeSelect.copa',
            'fas fa-beer2' =>'mesaggeSelect.copa2',
            'fas fa-beer3' =>'mesaggeSelect.copa3',
            
        ];
    }
}
