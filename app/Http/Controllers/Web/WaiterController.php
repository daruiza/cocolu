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
use Illuminate\Support\Facades\Session;
use App\Http\Traits\Web\WaiterRequestTrait;

class WaiterController extends Controller
{
    use WaiterRequestTrait;
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
        $waiters = Waiter::
			select('waiters.*')
			->leftjoin('users','waiters.user_id','users.id')
            ->where('users.rel_store_id', Auth::user()->store()->id)			
            ->where('users.active',1)
            ->orderBy('waiters.id','ASC')
            ->get();
		//dd($waiters->first()->user()->get()->first()->name);		
		return view('waiter.index',compact('waiters'))->with('data', []);
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

        //validate store        
        if(!Auth::user()->validateUserStore($request->input('store_id'))){            
            Session::flash('danger', [['WaiterCreateNOOk']]);
            return redirect('waiter');
            //return view('waiter.create',compact('waiter'))->with('danger', [['WaiterCreateNOOk']])->with('data', []);    
        }

		//this method create a acount		
		$this->validatorUser($request->all())->validate();
        if(!empty($request->file('image')))$this->validatorImage(['image'=>$request->file('image')])->validate();
		
		$request->request->add(['rol_id' => 3]);
		$request->request->add(['rel_store_id' => $request->input('store_id')]);		
		$request->request->add(['password' => \Hash::make($request->input('password'))]);					
		
		$user = new User();
		$user = $user->create($request->all());
		$user->repositoryWaiter($user->id);
        $user->updateUser($request->all()); 
		
		$request->request->add(['user_id' => $user->id]);						
		$waiter = new Waiter();
		$waiter->create($request->all());	
		
		//message
		Session::flash('success', [['WaiterCreateOk']]);
        return redirect('waiter');
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
            'description' => 'min:0|max:512',
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
}
