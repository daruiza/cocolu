<?php

namespace App\Http\Controllers\Web;

use App\Model\Core\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use App\Http\Traits\Web\TableRequestTrait;

class TableController extends Controller
{

    use TableRequestTrait;

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
        //dd(Table::find(1)->store()->get());
        //$tables = Table::all()->where('active',1);        
        $tables = Table::
            where('store_id',Auth::user()->store()->id)
            ->where('active',1)
            ->orderBy('id','DESC')
            ->get();
        return View::make('table.index')->with('data', ['tables'=>$tables]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return View::make('table.create')->with('data', []);
        $table = new Table();

        //validar session
        if(!Auth::check()) return redirect('/');
        //data es el listado de iconos disponibles
        //pero esto no es programación orientda a objetos
        //$data['icons'] = include 'icons_tabla.php';        
        return view('table.create',compact('table'))->with('data', []);
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
        Auth::user()->validateUserStore($request->input('store_id'));//validar store
        $table = new Table();
        //$table->storeTable($request->input());
        $table::create($request->input());        
        
        return view('table.create',compact('table'))->with('success', [['OK']])->with('data', []);
        //return Redirect::back()->with($request->input())->with('success', [['OK']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'show';
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
        return 'destroy';
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => '
                required|
                string|
                max:16',
            'description' => '
                max:64',
            'icon' => '
                required|
                string|                
                max:16',
            'order' => '                
                numeric|                
                digits_between:1,512',
            'active' => '
                required',
            
        ]);
    }
}
