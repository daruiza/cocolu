<?php

namespace App\Http\Controllers\Web;

use App\Model\Core\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

use App\Http\Traits\Web\TableRequestTrait;

class TableController extends Controller
{

    use TableRequestTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(Table::find(1)->store()->get());        
        return View::make('table.index')->with('data', ['tables'=>Table::all()->where('active',1)]);
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
        $table = new Table();
        $table->name = $request->input('name');
        $table->description = $request->input('description');
        $table->label = $request->input('label');
        
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
}
