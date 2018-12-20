<?php

namespace App\Http\Controllers\Web;

use App\Model\Core\Table;
use App\Model\Core\Service;

use App\Http\Controllers\Web\TableController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{	
	protected $tableController;

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
		$tables = Table::
            where('store_id',Auth::user()->store()->id)
            ->where('active',1)
            ->orderBy('id','ASC')
            ->get();
			
        if(!Auth::user()->validateUserStore($table->store_id)){			          
			//return tableController->index();
            //return view('table.index',compact('table'))->with('danger', [['NO_STORE_OWNER']])->with('data', []);
			//return Redirect::back()->with($request->input())->with('danger', [['NO_STORE_OWNER']])->with('data', []);
			return view('table.index',compact('tables'))->with('data', [])->with('danger', [['NO_STORE_OWNER']]);
        }
		//consult services open=true, and donot be register in table close
		//only one service have state open=true, when close -> open=false		
		$services = Service::
			where('table_id',$table->id)  
            ->where('open',1)            
            ->get();
		if($services->count()){
			//can not to create new service
			//now exist a service active
			return view('table.index',compact('tables'))->with('data', [])->with('danger', [['NO_SERVICE_CREATE']]);			
		}		
		
		//return view for create new service
		//return view('table.index',compact('tables','table'))->with('data', ['servicemodal'=>true,'table_id'=>$table->id])->with('success', [['SERVICE_NEW']]);		
		return view('table.index',compact('tables','table'))->with('data', ['servicemodal'=>true,'table_id'=>$table->id]);		
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
        if(!Auth::user()->validateUserStore($table->store_id)){         
            return view('table.index',compact('tables'))->with('data', [])->with('danger', [['NO_STORE_OWNER']]);
        }
        $service = new Service();        
        $service::create($request->input());
        return view('table.index',compact('tables','table'))->with('data', [])->with('success', [['SERVICE_NEW_OK']]);
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
    public function update(Request $request, Service $service)
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
