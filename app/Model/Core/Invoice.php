<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['id','number','description','support','tax','provider_id','store_id'];
}
