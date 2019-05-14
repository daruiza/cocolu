<?php

namespace App\Http\Traits\Web;

use App\User;
use App\Model\Core\Waiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

trait WaiterRequestTrait
{
    public function showResetForm(Request $request)
    {
       	$waiter = Waiter::findOrFail($request->input('id'));
        if(Auth::user()->validateUserStore($waiter->user()->first()->rel_store_id)){
            return view('waiter.change_password',compact('waiter'))->with('data', []);          
        }

        Session::flash('danger', [['WaiterChangePasswordNOOk']]);
        return redirect('waiter');
    }

    public function resetPassword(Request $request)
    {        
        $user = User::findOrFail($request->input('id'));
        $waiter = Waiter::findOrFail($request->input('waiter_id'));
    	if ($this->validatorPassword($request->all())->fails()) {    		
    		$message[0][0] = 'editPasswordNOOK';
    		return view('waiter.change_password',compact('waiter'))
            ->with(['danger'=> $message])
            ->withErrors($this->validatorPassword($request->all()));
		}

        $waiter = Waiter::findOrFail($request->input('waiter_id'));
        $wuser = $waiter->user()->first();        
        $wuser->password = Hash::make($request->input('password'));;
        $wuser->save();

        Session::flash('success', [['editPasswordOK']]);        
        return redirect('waiter');
        /*
        $message[0][0] = 'editPasswordOK';
        return view('waiter.change_password',compact('waiter'))
        ->with(['success'=> $message])
        ->withErrors($this->validatorPassword($request->all()));
        */
        
    }

    protected function validatorPassword(array $data)
    {
        return Validator::make($data, [            
            'password' => 'required|confirmed|min:4',
        ]);
    }    
	
}