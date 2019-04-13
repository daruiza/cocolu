<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = ['id','numero','name','description','logo','address','email','phone','active'];
}
