<?php

namespace App\Http\Controllers\Web;

use App\Model\Core\Table;
use App\Model\Core\Order;
use App\Model\Core\Waiter;
use App\Model\Core\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    public function __construct()
    {               
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $table = Table::find($request->input('table-id'));
        $service = $table->tableServiceOpen();

        if(!Auth::user()->validateUserStore($table->store_id)){
            //return tableController->index();
            //return view('table.index',compact('table'))->with('danger', [['NO_STORE_OWNER']])->with('data', []);
            //return Redirect::back()->with($request->input())->with('danger', [['NO_STORE_OWNER']])->with('data', []);            
            //return view('table.index',compact('tables'))->with('data', [])->with('danger', [['NO_STORE_OWNER']]);
            Session::flash('danger', [['NO_STORE_OWNER']]);
            return redirect('table');
        }

        //$ordermodal = true;
        //return redirect('table');
        //return redirect('table')->route('newPr')->withErrors(compact('state'));
        //return redirect('table')->with(compact('ordermodal'));
        //return redirect('table')->with('data', ['ordermodal'=>true,'table_id'=>$table->id]);
        $tables = Table::where('store_id',Auth::user()->store()->id)
            ->where('active',1)
            ->orderBy('id','ASC')
            ->get();

        $waiters = Waiter::waitersByStoreSelect();                                 
        $products = Product::productstByStore();             
        $categories = array();                        

        foreach ($products as $value) {
            if(!in_array($value->category,$categories))$categories[]=$value->category;
        }
        
        return view('table.index',compact('tables','table','waiters','products','categories'))->with('data', ['ordermodal'=>true,'table_id'=>$table->id]
        );
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        //validamos
        $table = Table::find($request->input('table-id'));
        if(!Auth::user()->validateUserStore($table->store_id)){
            Session::flash('danger', [['NO_STORE_OWNER']]);
            return redirect('table');
        }
        
        $order_serial = Order::select('serial')
            ->where('service_id',$service->first()->id)
            ->max('serial');

        if(empty($order_serial)){
            $order_serial = 1;
        }else{
            $order_serial++;
        }
        

        dd($request);
        return 'guardado de orenes';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Core\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Core\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Core\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Core\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
