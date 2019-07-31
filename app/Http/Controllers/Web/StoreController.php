<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Model\Core\Store;
use App\Model\Core\Department;
use App\Model\Core\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use App\Http\Traits\Web\UserRequestAjax;
use App\Http\Traits\Web\StoreRequestTrait;

class StoreController extends Controller
{

    use UserRequestAjax;
    use StoreRequestTrait;

    public function __construct()
    {
        $this->middleware('auth',['except' => 'index']);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => '
                required|
                string|
                max:16',
            'department' => '
                required|
                string',
            'city' => '
                required|
                string',   
            'currency' => '
                required|
                max:12',
            //'password' => 'required|string|min:4|confirmed',
        ]);
    }

    protected function validatorImage(array $data)
    {        
        return Validator::make($data, [
            'image'=>'
                required|
                mimes:jpeg,bmp,png|
                dimensions:max_width=700,max_width=700|
                dimensions:min_width=250,min_width=250',            
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($store)
    {
        $store = Store::where('name', strtolower($store))->firstOrFail();       
        return view('store.index',compact('store'));
        //return 'Hola';       
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {     

        $user = new User();
        $user = User::findOrFail($id);        
        //validación de credenciales de usuario
        if(!$user->validateUser())return Redirect::back()->with('danger', [['sorryTruncateUser']]);                
        $store = $user->store();        
        $store->storeheight = json_decode($store->label)->table->StoreHeight;
        $store->tableheight = json_decode($store->label)->table->TableHeight;
        $store->colorbody = json_decode($store->label)->table->colorbody;        
        $store->selecttable = json_decode($store->label)->table->selectTable;
        $store->serviceopentable = json_decode($store->label)->table->serviceOpenTable;
        $store->colorrow = json_decode($store->label)->table->colorRow;
        $store->colorinactive = json_decode($store->label)->table->colorInactive;
        $store->ordernew = json_decode($store->label)->order->OrderNew;
        $store->orderok = json_decode($store->label)->order->OrderOK;
        $store->orderpay = json_decode($store->label)->order->OrderPay;
        $store->ordercancel = json_decode($store->label)->order->OrderCancel;
        $store->os = json_decode($store->label)->print->os;
        $store->conn = json_decode($store->label)->print->conn;
        $store->status_server = json_decode($store->label)->behavior->status_server;

                
        $departments = Department::departments();
        $cities = [];
        if(!empty($store->department)){
            $cities = City::cities($store->department);            
        }
        //enviar los datos

        return view('store.edit',compact('store','departments','cities'))->with('data', ['options'=>$user->rol_options()]);
        //return View::make('store.edit');
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

        //$this->validator($request->all())->validate();
        if ($this->validator($request->all())->fails()) {
            return Redirect::back()->withErrors($this->validator($request->all()))->withInput();
            //return Redirect::back()->withErrors($this->validator($request->all()))->withInput()->with('modulo',$moduledata);
        }

        if(!empty($request->file('image')))$this->validatorImage(['image'=>$request->file('image')])->validate();

        $store = new Store();
        $store = Store::find($id);

        //validamos que la tienda sea del usuario
        $user = new User();        
        if($user->validateUserStore($store->id)){                        
            if(!$store->updateStore($request->all())->id){
                $message[0][0] = 'sorryNoUpdateStore';            
                return Redirect::back()->with('danger', $message);
            }
        }

        $message[0][0] = 'editStoreOK';
        
        $departments = Department::departments();        
        if(!empty($store->department)){
            $cities = City::cities($store->department);            
            return view('store.edit',compact('store','departments','cities'))
                ->with('success', $message)
                ->with('data', ['options'=>$user->rol_options()]);
        }


        return view('store.edit',compact('store','departments'))
            ->with('success', $message)
            ->with('data', ['options'=>$user->rol_options()]);
    
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
    
}