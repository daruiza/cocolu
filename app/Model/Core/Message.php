<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['id','issue','body','rel_store_id'];
}
