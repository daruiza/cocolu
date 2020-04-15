<?php

namespace App\Http\Controllers\Web;

use App\Model\Core\Table;
use App\Model\Core\Service;
use App\Model\Core\Order;
use App\Model\Core\Clousure;

use App\Http\Controllers\Web\TableController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use App\Http\Traits\Web\ServiceRequestTrait;

use DateTime;

class ServiceController extends Controller
{	
	//protected $tableController;
    use ServiceRequestTrait;

    public function __construct()
    {               
        $this->middleware('auth');
		//$this->tableController = new TableController();
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
    
    /*para crear un nuevo servicio para una table
     *1. que no hallan mas servicios para esta mesa estado open
     *2. se necesita que la mesa sea de la tienda
     *3. Pueden haber mmuchos servicios en un dia pero solo uno activo
	 *4. Para crar un nuevo servio la mesa debe tener todos los demas servicios deactivados
     */
    public function create(Request $request)
    {        
		//$request bring table id
		//1 validate owner table
		//validar store
		$table = Table::find($request->input('id'));		
			
        //$table = Table::find($request->input('table-id'));
        //$service = $table->tableServiceOpen();

        if(!Auth::user()->validateUserStore($table->store_id)){            
            Session::flash('danger', [['NO_STORE_OWNER']]);
            return redirect('table');
        }

        $tables = Table::
            where('store_id',Auth::user()->store()->id)
            ->where('active',1)
            ->orderBy('id','ASC')
            ->get();

        $orders = Order::ordersStatusOne(Auth::user()->store()->id);
        
        $services = Service::
            where('table_id',$table->id)  
            ->where('open',1)            
            ->get();

        $allservices = Service::
            where('tables.store_id',Auth::user()->store()->id)
            ->leftJoin('tables','tables.id','services.table_id')                      
            ->get();    
        
        if($services->count()){            
            //now exist a service active
            if($table->tableOrderStatusOneTwoOpen()->count()){
                Session::flash('danger', [['SERVICE_DONT_CLOSE']]);    
            }else{
                //Session::flash('info', [['SERVICE_CLOSE_OK']]);    
                return view('table.index',compact('tables','table','orders'))
                ->with('data', ['servicemodalclose'=>true]);    
            }
            return redirect('table');               
        }
        
        $number = 0;
        if($allservices->max('number')){
            $number = $allservices->max('number') + 1;
        }
                
        //Session::flash('data', ['servicemodal'=>true]);
        //$data = ['servicemodal'=>true];
        //return redirect('table')->with(compact('table','data'))->with('data',['servicemodal'=>true]);
        return view('table.index',compact('tables','table','orders','number'))
        ->with('data', ['servicemodal'=>true]);		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = Table::find($request->input('table_id'));
        $tables = Table::
            where('store_id',Auth::user()->store()->id)
            ->where('active',1)
            ->orderBy('id','ASC')
            ->get();
        $orders = Order::ordersStatusOne(Auth::user()->store()->id);

        $services = Service::
            where('table_id',$request->input('table_id'))  
            ->where('open',1)            
            ->get();
        if($services->count()){
           return view('table.index',compact('tables','table','orders'))
           ->with('data', [])->with('danger', [['NO_MULTI_SERVERS']]); 
        }    

        if(!Auth::user()->validateUserStore($table->store_id)){         
            return view('table.index',compact('tables','table','orders'))
            ->with('data', [])->with('danger', [['NO_STORE_OWNER']]);
        }

        $service = new Service();
		//fecha y hora
		$today = new DateTime();
		$today = $today->format('Y-m-d H:i:s');		
		$request->request->add(['date_open' => $today]);
		
        $cousure = Clousure::
            where('store_id',Auth::user()->store()->id)
            ->where('open',1)
            ->get();
        //validate only one Clousure        
        if($cousure->count() <> 1){         
            return view('table.index',compact('tables','table','orders'))
            ->with('data', [])->with('danger', [['NO_ONLYONE_CLOUSURE']]);
        }

		$request->request->add(['rel_clousure_id' => $cousure->first()->id]);		
		//dd($request->input());       

        $service::create($request->input());
        
        //verificate onli one service
        /*****/
        
        return view('table.index',compact('tables','table','orders'))
        ->with('data', [])->with('success', [['SERVICE_NEW_OK']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
