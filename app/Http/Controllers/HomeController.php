<?php

namespace App\Http\Controllers;

use App\Model\Core\Order;
use App\Model\Core\Product;

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

                $orders = Order::orderStatus(
                    Auth::user()->store()->clousureOpen(),
                    json_decode(Auth::user()->store()->label,true)['order'],
                    json_decode(Auth::user()->store()->label,true)['order_status']
                );

                $orderpaid = Order::ordersPaid(Auth::user()->store()->clousureOpen());
                $orderstopay = Order::orderToPay(Auth::user()->store()->clousureOpen());
                $services = Auth::user()->store()->clousureOpen()->services()->count();
                $ordercount = Order::ordersClousure(Auth::user()->store()->clousureOpen());
                $orderclosecount = Order::ordersCancelClousure(Auth::user()->store()->clousureOpen());

                //productos consumidos
                $products = Product::productByClousure(Auth::user()->store()->clousureOpen());
                
                $page = 'admin_dashboard';
                
                return view('welcome',compact('page','orders','orderpaid','orderstopay','services','ordercount','orderclosecount','products'))
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
