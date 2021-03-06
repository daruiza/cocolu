<?php

namespace App\Http\Controllers\Web;

use App\Model\Core\Table;
use App\Model\Core\Order;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\OrderController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

use App\Http\Traits\Web\TableRequestTrait;

class TableController extends Controller
{

    use TableRequestTrait;
	protected $serviceController;

    public function __construct()
    {               
        $this->middleware('auth');
		$this->serviceController = new ServiceController();
        $this->orderController = new OrderController();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        
        //$tables = Table::all()->where('active',1);
        $tables = Table::
            where('store_id',Auth::user()->store()->id)
            ->where('active',1)
            ->orderBy('id','ASC')
            ->get();

        //listamos las ordenes pendientes por atender de esta clousure        
        $orders = Order::ordersStatusOne(Auth::user()->store()->id);
		return view('table.index',compact('tables','orders'))->with('data', []);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return View::make('table.create')->with('data', []);
        $table = new Table();
        if($table->validateAcount()){
            Session::flash('danger', [['NoMoreTables']]);
            return redirect('table');
        }
        //validar session
        //if(!Auth::check()) return redirect('/');
        //data es el listado de iconos disponibles
        //pero esto no es programación orientda a objetos
        //$data['icons'] = include 'icons_tabla.php';        
        return view('table.create',compact('table'))->with('data', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();       
        $table = new Table();
        //validar store
        if(Auth::user()->validateUserStore($request->input('store_id'))){
            $table = new Table();
            //$table->storeTable($request->input());
            $table::create($request->input());
			Session::flash('success', [['TableCreateOk']]);
			return redirect('table');
            //return view('table.create',compact('table'))->with('success', [['OK']])->with('data', []);    
        }		
        return view('table.create',compact('table'))->with('danger', [['NOOK']])->with('data', []);
        //return Redirect::back()->with($request->input())->with('success', [['OK']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $table = Table::find($request->input('id'));                
        return view('table.show',compact('table'))->with('success', [[]])->with('data', []);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {        
        $table = Table::find($request->input('id'));
        return view('table.edit',compact('table'))->with('data', []);
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
        
        //validar store
        if(Auth::user()->validateUserStore($request->input('store_id'))){
            $table = Table::find($id);
            $table->storeTable($request->input());
            //$table::save(); 
			Session::flash('success', [['TableEditOk']]);
			return redirect('table');	
            //return view('table.edit',compact('table'))->with('success', [['OK']])->with('data', []);

        }
		$table = Table::find($request->input('id'));
        return view('table.edit',compact('table'))->with('danger', [['NOOK']])->with('data', []);       
        //return Redirect::back()->with($request->input())->with('success', [['OK']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //lo mejor es no destriur sino, desactivar
        $table = Table::find($request->input('id'));
        
        if(!Auth::user()->validateUserStore($table->store_id)){            
            Session::flash('danger', [['NO_STORE_OWNER']]);
            return redirect('product');
        }
        
        $table->active = 0;
        $table->save();

        Session::flash('success', [['tableDeleteOk']]);
        return redirect('table');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => '
                required|
                string|
                max:16',
            'description' => '
                max:512',
            'icon' => '
                required|
                string|                
                max:32',
            'order' => '                
                numeric|                
                digits_between:1,512',
            'active' => '
                required',
            
        ]);
    }
}
