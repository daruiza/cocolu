<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\Core\Product;
use App\Model\Core\Order;
use App\Model\Core\OrderProduct;
use App\Model\Core\Service;
use App\Model\Core\Stock;
use App\Model\Core\Waiter;
use App\Model\Core\Clousure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DateTime;

class ClosureController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Orders by service para la consulta de una mesa dada su servicio
    public function index(Request $request){
        return response()->json($request->user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }


}