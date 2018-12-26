<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Model\Core\Waiter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class WaiterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function __construct()
    {               
        $this->middleware('auth');		
    }
     
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
        $waiter = new Waiter();
        return view('waiter.create',compact('waiter'))->with('data', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
		dd($request);
		//this method create a acount		
		$this->validatorUser($request->all())->validate();
		
		$request->request->add(['rol_id' => 3]);
		$request->request->add(['rel_store_id' => $request->input('store_id')]);		
		$request->request->add(['password' => \Hash::make($request->input('password'))]);						
		$user = new User();
		$user->create($request->all());
		$user->repository($user->id);
		
		$request->request->add(['user_id' => $user->id]);				
		$waiter = new Waiter()
		$waiter->create($request->all());
		
		
        return "store";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Waiter  $waiter
     * @return \Illuminate\Http\Response
     */
    public function show(Waiter $waiter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Waiter  $waiter
     * @return \Illuminate\Http\Response
     */
    public function edit(Waiter $waiter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Waiter  $waiter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Waiter $waiter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Waiter  $waiter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Waiter $waiter)
    {
        //
    }
	
	protected function validatorUser(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:16',
            'email' => 'required|string|email|max:128|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);
    }
}
