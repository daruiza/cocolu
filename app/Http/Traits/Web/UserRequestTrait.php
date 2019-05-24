<?php

namespace App\Http\Traits\Web;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

trait UserRequestTrait
{

    public function showResetForm(Request $request)
    {   
    	
    	$user = User::findOrFail($request->input('id'));
    	if(!$user->validateUser())return Redirect::back()->with('danger', [['sorryTruncateUser']]);
        return view('user.passwords.reset')
            ->with(['token' => $request->input('_token'),'options'=>$user->rol_options()])
            ->with('data', ['options'=>$user->rol_options()]);

    }

    public function resetPassword(Request $request)
    {
        $user = User::findOrFail($request->input('id'));
    	if ($this->validatorPassword($request->all())->fails()) {
            
    		$message[0][0] = 'editPasswordNOOK';
    		return view('user.passwords.reset')
            ->with(['token' => $request->input('_token'),
                    'options'=>$user->rol_options(),
                    'danger'=> $message])
            ->with('data', ['options'=>$user->rol_options()])
            ->withErrors($this->validatorPassword($request->all()));
		}

        $user->password = Hash::make($request->input('password'));;
        $user->save();
        $message[0][0] = 'editPasswordOK';
        return view('user.passwords.reset')
            ->with(['token' => $request->input('_token'),
                    'options'=>$user->rol_options(),
                    'success'=> $message])
            ->with('data', ['options'=>$user->rol_options()])
            ->withErrors($this->validatorPassword($request->all()));
        
    }

    protected function validatorPassword(array $data)
    {
        return Validator::make($data, [
            'token' => 'required',            
            'password' => 'required|confirmed|min:6',
        ]);
    }

    

    
	
}