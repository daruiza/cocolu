<?php

namespace App\Http\Controllers\Web;

use App\Model\Core\Expense;
use App\Model\Core\Clousure;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;



class ExpenseController extends Controller
{

    public function __construct()
    {               
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::            
            leftJoin('clousures','clousures.id','expenses.clousure_id')
            ->where('clousures.store_id',Auth::user()->store()->id)            
            ->orderBy('expenses.id','ASC')
            ->get();
        
        return view('expense.index',compact('expenses'))->with('data', []);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expense = new Expense();
        $clousure = new Clousure();        
        return view('expense.create',compact('expense','clousure'))->with('data', []);
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
        //validar store
        if(!Auth::user()->validateUserStore($request->input('store-id'))) {
          return Redirect::back()->with('danger', [['NO_STORE_OWNER']]);  
        } 

        $expense = new Expense();
        $request->request->add(['clousure_id' => Auth::user()->store()->clousureOpen()->id]);            
        $expense::create($request->input());

        Session::flash('success', [['ExpenseCreateOk']]);
        return $this->index();
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

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => '
                required|
                string|
                max:32',
            'description' => '
                max:512',            
            'value' => '                
                numeric|
                required|
                not_in:0|
                integer|min:0',   
        ]);
    }
}
