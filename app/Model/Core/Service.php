<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['id','name','description','date_open','date_close','kept','open','rel_clousure_id','table_id'];

    public function table(){
		//no usa el namespace
        return $this->belongsTo(Table::class);
    }

    public function clousure(){
		//no usa el namespace		
        $clousure = 
        	Clousure::select('clousures.*')        	
        	->rightJoin('services','clousures.id','services.rel_clousure_id')
        	->where('services.rel_clousure_id',$this->rel_clousure_id)
        	->distinct();
        return $clousure;
    }
}
