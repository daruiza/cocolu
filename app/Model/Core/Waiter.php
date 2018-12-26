<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Waiter extends Model
{
    protected $fillable = ['id','description','label','active','user_id'];
}
