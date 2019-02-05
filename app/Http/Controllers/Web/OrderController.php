<?php

namespace App\Http\Controllers\Web;

use App\Model\Core\Table;
use App\Model\Core\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
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
        $tables = Table::
            where('store_id',Auth::user()->store()->id)
            ->where('active',1)
            ->orderBy('id','ASC')
            ->get();
            
        //mandamos la lista de meseros
        //los productos y sus catagorias

        return view('table.index',compact('tables','table'))->with('data', ['ordermodal'=>true,'table_id'=>$table->id]);
       
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
