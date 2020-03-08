<?php 

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\Core\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class OrderController extends Controller{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
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

    public function products(Request $request){
        $products = Product::productstByStore($request->user()->rel_store_id);
        $categories = array();
        foreach ($products as $value) {
            if(!in_array($value->category,$categories))$categories[]=$value->category;
        }
        return response()->json(['products'=>$products,'categories'=>$categories]);
    }

}