<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['id','name','description','date','kept','open','table_id'];
}
