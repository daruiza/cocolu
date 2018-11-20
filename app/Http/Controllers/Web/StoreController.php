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

class StoreController extends Controller
{

    use UserRequestAjax;

    public function __construct()
    {
        $this->middleware('auth');
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
    public function index()
    {
        dd('store.controller');
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
        $departments = Department::departments();
        $cities = [];
        if(!empty($store->department)){
            $cities = City::cities($store->department);            
        }
        //enviar los datos

        return view('store.edit',compact('store','departments','cities'));
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
            return view('store.edit',compact('store','departments','cities'))->with('success', $message);
        }        
        return view('store.edit',compact('store','departments'))->with('success', $message);
    
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