<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Expense extends Model
{
    protected $fillable = ['id','name','description','value','support','clousure_id'];

    public function scopeName($query,$name){
        if($name){
            return $query->where('expenses.name','LIKE',"%$name%");
        }
    }
    
    public function scopeDescription($query,$description){
        if($description){
            return $query->where('expenses.description','LIKE',"%$description%");
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

   	//un gasto pertenece a un cierre
    public function clousure(){
        return $this->belongsTo(Clousure::class);
    }

    static function totalexpenseClousure(Clousure $clousure){    	
    	return  Expense::select('*')->where('clousure_id',$clousure->id)->sum('value');        
    }
    
}
