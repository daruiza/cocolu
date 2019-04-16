<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = ['id','number','name','description','logo','address','email','phone','active','store_id'];
}
