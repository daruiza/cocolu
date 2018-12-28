<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['id','name','description','date','kept','open','rel_clousure_id','table_id'];
}
