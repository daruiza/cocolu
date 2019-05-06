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

use DateTime;

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
            select('expenses.*')
            ->leftJoin('clousures','clousures.id','expenses.clousure_id')
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

         if(!empty($request->file('image'))){
            $this->validatorImage(['image'=>$request->file('image')])->validate();
             if($request->file('image')->isValid()){
                $destinationPath = 'users/'.Auth::user()->id.'/supports';
                $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
                $fileName_image = rand(1,9999999).'.'.$extension; // renameing image
                $request->file('image')->move($destinationPath, $fileName_image);
                chmod('users/'.Auth::user()->id.'/supports/'.$fileName_image, 0777);

                $request->request->add(['support' => $fileName_image]);
             }
         }
        
        $request->request->add(['clousure_id' => Auth::user()->store()->clousureOpen()->id]);

        $expense = new Expense();                    
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
    public function edit(Request $request,$id)
    {
        //editar solo antes de trres minutos
        $expense = Expense::find($request->input('id'));
        $date_create = $expense->created_at->modify("+15 minutes");
        //$date_create = $date_create->format('Y-m-d H:i:s');

        $today = new DateTime();
        //$today = $today->format('Y-m-d H:i:s');
        $diff = $today->diff($date_create);
        $diff = intval($diff->format('%i'));
        
        if($diff > intval(json_decode(Auth::user()->store()->label,true)['table']['graceTimeExpense'])){            
            //y no podemos editar el gasto, ha pasado el tiempo de gracia
            Session::flash('danger', [['ExpenseEditOutGraceTime']]);
            return $this->index();
        }
        

        //en caso de pasar el filtro se procede a editar
        $expense = Expense::find($request->input('id'));
        $clousure = new Clousure();    
        return view('expense.edit',compact('expense','clousure'))->with('data', []);        
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
        if(!Auth::user()->validateUserStore($request->input('store-id'))) {
          return Redirect::back()->with('danger', [['NO_STORE_OWNER']]);  
        }

        $expense = Expense::find($id);

        $expense->name=$request->input('name');
        $expense->description=$request->input('description');
        $expense->value=$request->input('value');
        $expense->save();
         
        Session::flash('success', [['ExpenseEditOk']]);
        return $this->index();   
        
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

     protected function validatorImage(array $data)
    {        
        return Validator::make($data, [
            'image'=>'
                required|
                mimes:jpeg,bmp,png',            
        ]);
    }
}
