<?php

namespace App\Http\Controllers;

use App\Model\Core\Order;

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

            if(Auth::user()->rol()->first()->id == 1){                
                return view('welcome');    
            }

            if(Auth::user()->rol()->first()->id == 2){                
                //consultamos las ordenes del clousure open
                /*
                $orders = array();                
                foreach (Auth::user()->store()->clousureOpen()->services() as $key_o => $orders_array) {
                    foreach ($orders_array->orders()->get() as $key_r => $order) {
                        $orders[] = $order;
                    }                    
                }
                */
                $orders = Order::orderStatus(Auth::user()->store()->clousureOpen());


                
                $page = 'admin_dashboard';

                return view('welcome',compact('page','orders'))
                ->with('data',['options'=>Auth::user()->rol_options_dashboard()]);    
            }

            if(Auth::user()->rol()->first()->id == 3){                
                return view('welcome');    
            }

            

            
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
