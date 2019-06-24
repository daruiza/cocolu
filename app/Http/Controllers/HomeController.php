<?php

namespace App\Http\Controllers;

use App\Model\Core\Order;
use App\Model\Core\Product;
use App\Model\Core\Stock;
use App\Model\Core\Expense;
use App\Model\Core\Clousure;

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
    public function index(Clousure $clousure){
        
        if(Auth::check()) {

            if(Auth::user()->rol()->first()->id == 1){
                $page = 'home';
                return view('welcome',compact('page'));    
            }
            
            if(empty($clousure->id))$clousure = Auth::user()->store()->clousureOpen();
            
            
            if(Auth::user()->rol()->first()->id == 2){

                $page = 'admin_dashboard';
                $store = Auth::user()->store();
                //para pintar el chart de ordenes y sus estados
                $orders = Order::orderStatus(
                    $clousure,
                    json_decode(Auth::user()->store()->label,true)['order'],
                    json_decode(Auth::user()->store()->label,true)['order_status']
                );
                //ordenes pagadas $plata
                $orderpaid = Order::ordersPaid($clousure);
                //ordenes por pagar $plata
                $orderstopay = Order::orderToPay($clousure);
                $services = $clousure->servicesAll()->count();
                //Ordenes terminadas
                $ordercount = Order::ordersClousure($clousure);
                $orderclosecount = Order::ordersCancelClousure($clousure);

                //productos consumidos
                $products = Product::productByClousure($clousure);

                //consumo total de productos e ingredientes
                $ingredients = Stock::productByClousure($clousure);

                //gastos
                $totalexpense = Expense::totalexpenseClousure($clousure);
                
                return view('welcome',compact('page','store','orders','orderpaid','orderstopay','services','ordercount','orderclosecount','products','ingredients','totalexpense'))
                ->with('data',['options'=>Auth::user()->rol_options_dashboard()]);    
            }

            if(Auth::user()->rol()->first()->id == 3){  
                $page = 'waiter_dashboard';              
                return 
                view('welcome',compact('page'))
                ->with('data',['options'=>Auth::user()->rol_options_dashboard()]);
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
