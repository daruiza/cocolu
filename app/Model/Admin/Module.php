<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
     protected $fillable = ['name','description','label','active'];
}
