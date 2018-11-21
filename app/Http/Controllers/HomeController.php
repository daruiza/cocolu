<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Web\HomeRequestTrait;

use App;

class HomeController extends Controller
{

    use HomeRequestTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
               
        //$this->middleware('auth', ['except' => 'index','postLocale']);
        //$this->middleware('guest', ['except' => 'index','postLocale']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$rol = App\Model\Admin\Rol::find(1);
        //dd($rol->users);

        //primer ciclo recorre todas las opciones

        //$option = App\Model\Admin\Option::find(1);
        //dd($option->module);

        //dd(Session::get('permits'));
        //dd(Auth::user()->rol()->get()[0]);
        return view('welcome');
    }

    /**
    *
    *Lang
    *
    */    

    public function postLocale(Request $request){
        Session::put('applocale', $request->input('lang'));        
        App::setLocale($request->input('lang'));        
        return redirect('/');
    }    
}
