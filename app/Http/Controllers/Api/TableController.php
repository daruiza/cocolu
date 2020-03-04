<?php 

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\Core\Table;
use App\Model\Core\Service;
use App\Model\Core\Order;
use App\Model\Core\Clousure;

use App\Model\Admin\Acount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Web\UserRequestTrait;

use DateTime;

class TableController extends Controller{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Obtiene las mesas del salon
        $tables = Table::
            where('store_id',$request->user()->store()->id)
            ->where('active',1)
            ->orderBy('id','ASC')
            ->get();

        return response()->json($tables);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Evalua si una tabla tiene Servico y lo retorna
    public function tableServiceOpen(Request $request, $id){
        $table = Table::find($id);
        return response()->json($table->tableServiceOpen());
    }

    // Crea un nuevo servico
    public function tableServiceSave(Request $request){

    	$table = Table::find($request->input('params')['id_table']);        

    	// Miramos que no tenga mas servicis
    	// por precausións
        $services = Service::
            where('table_id',$request->input('params')['id_table'])  
            ->where('open',1)            
            ->get();

        if($services->count()){
        	return response()->json(['message' => 'NO_MULTI_SERVERS'], 404);
        }

        $service = new Service();
        $today = new DateTime();
		$today = $today->format('Y-m-d H:i:s');

		
		$cousure = Clousure::
            where('store_id',$table->store_id)
            ->where('open',1)
            ->get();

        if($cousure->count() <> 1){
        	return response()->json(['message' => 'NO_ONLYONE_CLOUSURE'], 404);
        }    
        


        return response()->json($cousure);	    

    }

   
}
