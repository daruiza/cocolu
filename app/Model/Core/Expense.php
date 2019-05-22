<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['id','name','description','value','support','clousure_id'];

   	//un gasto pertenece a un cierre
    public function clousure(){
        return $this->belongsTo(Clousure::class);
    }

    static function totalexpenseClousure(Clousure $clousure){    	
    	return  Expense::select('*')->where('clousure_id',$clousure->id)->sum('value');        
    }
    
}
