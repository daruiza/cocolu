<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Model\Core\Store;
use App\Model\Core\Clousure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClousureController extends Controller
{
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clousure  $clousure
     * @return \Illuminate\Http\Response
     */
    public function show(Clousure $clousure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clousure  $clousure
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        
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
        $user = User::findOrFail($id);
        //validación de credenciales de usuario
       if(!$user->validateUser())return Redirect::back()->with('danger', [['sorryTruncateUser']]);
       //$store = $user->store();        
       $clousure = $user->store()->clousureOpen();
       dd($clousure);
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
