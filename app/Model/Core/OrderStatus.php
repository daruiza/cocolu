<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table ='order_status';
    protected $fillable = ['id','name'];	
}
