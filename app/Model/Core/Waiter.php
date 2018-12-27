<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Waiter extends Model
{
    protected $fillable = ['id','description','label','user_id'];
	
	//a waite is a user
    public function user(){
        return $this->belongsTo('App\User');
    }
}


