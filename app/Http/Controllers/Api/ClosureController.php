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
use Illuminate\Support\Facades\Validator;

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
    public function index(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Validación de campos
        $this->validator($request->input())->validate();

        $current_closure = Clousure::where('store_id', $request->user()['rel_store_id'])->where('open', 1)->first();
        if ($current_closure) {
            return response()->json(['message' => 'Ya hay una labor en curso.'], 404);
        }

        $today = new DateTime();
        $today = $today->format('Y-m-d H:i:s');
        $closure = new Clousure();
        $closure->store_id = $request->user()['rel_store_id'];
        $closure->date_open = $today;
        $closure->name = $request->input('name');
        $closure->description = $request->input('description');
        $closure->open = 1;
        $closure->save();

        return response()->json($closure);
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

    public function open(Request $request)
    {
        $cousure = Clousure::where('store_id', $request->user()['rel_store_id'])->where('open', 1)->first();
        return response()->json($cousure);
    }

    public function close(Request $request)
    {
        $closure = Clousure::where('store_id', $request->user()['rel_store_id'])->where('open', 1)->first();
        if (!$closure) {
            return response()->json(['message' => 'No hay labores por cerrar'], 404);
        }

        // verificamos que no hallan servicios abriertos
        $services = Service::where('open', 1)->get();
        if (count($services)) {
            return response()->json(['message' => 'Mientras hallan servicios por cerrar no se puede cerrar la labor'], 404);
        }
        $today = new DateTime();
        $today = $today->format('Y-m-d H:i:s');
        $closure->date_close = $today;
        $closure->open = 0;
        $closure->save();

        return response()->json($closure);
    }

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
}
