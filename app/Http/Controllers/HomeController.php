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
        if(Auth::check()) {
            if(Auth::user()->rol()->first()->id){
                $page = 'admin_dashboard';
                return view('welcome',compact('page'));    
            }
            $page = 'waiter_dashboard';
            return view('welcome',compact('page'));
        }

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
