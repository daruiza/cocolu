<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['id','name','description','value','clousure_id'];

   	//un gasto pertenece a un cierre
    public function clousure(){
        return $this->belongsTo(Clousure::class);
    }
    
}
