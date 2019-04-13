<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['id','numero','description','support','tax','provider_id'];
}
