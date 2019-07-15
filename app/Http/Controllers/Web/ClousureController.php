<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Model\Core\Store;
use App\Model\Core\Clousure;
use App\Model\Core\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

use App\Http\Traits\Web\ClousureRequestTrait;

use DateTime;

class ClousureController extends Controller
{

    use ClousureRequestTrait;

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => '
                required|
                string|
                max:32',
            'description' => '
                required|
                string'
        ]);
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clousure  $clousure
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $clousures = Clousure::where('open',0)->get();        
        return redirect('/')->with('clousure-modal-create', $clousures);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clousure  $clousure
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {        
        $user = User::findOrFail($id);
        //validación de credenciales de usuario
        if(!$user->validateUser())return Redirect::back()->with('danger', [['sorryTruncateUser']]);

        //validar si tiene servicios con odenes sin pagar
        $orders = $user->store()->clousureOpen()->servicesBuilder()
        ->leftJoin('orders','orders.service_id','services.id')
        ->where('orders.status_id',1)
        ->orWhere('orders.status_id',2)
        ->get();

        if($orders->count()){            
            Session::flash('danger', [['orderOpen']]);
            return  app('App\Http\Controllers\HomeController')->index(Auth::user()->store()->clousureOpen());
        }
        
        $page = 'clousure.edit';
        return view('welcome',compact('page','user'))
        ->with('data',['options'=>Auth::user()->rol_options_dashboard()]);    
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clousure  $clousure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validator($request->all())->validate();
        $user = User::findOrFail($id);

        //validación de credenciales de usuario
        if(!$user->validateUser())return Redirect::back()->with('danger', [['sorryTruncateUser']]);

        $today = new DateTime();
        $today = $today->format('Y-m-d H:i:s');

        $clousure = $user->store()->clousureOpen();
        Service::closeServices($clousure);//cierra todos los servicios
        $clousure->description = $request->input('description');
        $clousure->date_close = $today;
        $clousure->open = 0;
        $clousure->save();

        //cerramos todos los servicios que pudieron quedar abiertos


        $new_colusure = new Clousure();
        $new_colusure->name = $request->input('name');
        $new_colusure->description = $request->input('new_description');
        $new_colusure->store_id = $user->store()->id;
        $new_colusure->save();
                
        Session::flash('success', [['workClousureOK']]);
        return  app('App\Http\Controllers\HomeController')->index(Auth::user()->store()->clousureOpen());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clousure  $clousure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clousure $clousure)
    {
        //
    }
}
