<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Model\Admin\Acount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

 	public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => '
                required|
                string|
                max:16',
            'surname' => '
                max:16',
            'email' => '
                required|
                string|
                email|
                max:128|
                unique:users,email,'.Auth::user()->id,
            'phone' => '
                max:32',
            //'password' => 'required|string|min:4|confirmed',
        ]);
    }

    protected function validatorImage(array $data)
    {        
        return Validator::make($data, [
            'image'=>'
                required|
                mimes:jpeg,bmp,png|
                dimensions:max_width=700,max_width=700|
                dimensions:min_width=250,min_width=250',            
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mensaje con respecto a la cuenta basica
        Acount::infoUserAcount(Auth::user()->id);
        $user = new User();     
        return View::make('user.index')->with('data', ['options'=>$user->rol_options()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $user = new User();
        $user = User::findOrFail($id);

        //validación de credenciales de usuario
       if(!$user->validateUser())return Redirect::back()->with('danger', [['sorryTruncateUser']]);

        //enviamos los datos
        Session::flash('_old_input.name', Auth::user()->name);
        Session::flash('_old_input.surname', Auth::user()->surname);
        Session::flash('_old_input.email', Auth::user()->email);
        Session::flash('_old_input.phone', Auth::user()->phone);
        Session::flash('_old_input.avatar', Auth::user()->avatar);        

        return View::make('user.edit');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        
        $this->validator($request->all())->validate();
        if(!empty($request->file('image')))$this->validatorImage(['image'=>$request->file('image')])->validate();       
                
        $user = new User();
        $user = User::find($id);
        $user->validateUser();
        if(!$user->updateUser($request->all())->id){
            $message[0][0] = 'sorryNoUpdateUser';            
            return Redirect::back()->with('danger', $message);
        }

        //actualizamos la variable global session
        Session::flash('_old_input.name', Auth::user()->name);
        Session::flash('_old_input.surname', Auth::user()->surname);
        Session::flash('_old_input.email', Auth::user()->email);
        Session::flash('_old_input.phone', Auth::user()->phone);
        Session::flash('_old_input.avatar', Auth::user()->avatar);        
        
        $message[0][0] = 'editUserOK';            
        return Redirect::back()->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
