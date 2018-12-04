<?php

namespace App\Http\Traits\Web;

use App\Model\Core\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

trait TableRequestTrait
{
	
	public function drag($id)
    {
        $tables = Table::
            where('store_id',Auth::user()->store()->id)
            ->where('active',1)
            ->orderBy('id','DESC')
            ->get();
        return View::make('table.index_drag')->with('data', ['tables'=>$tables]);
    }
	
}