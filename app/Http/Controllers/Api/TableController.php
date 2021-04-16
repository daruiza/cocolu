<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\Core\Table;
use App\Model\Core\Service;
use App\Model\Core\Order;
use App\Model\Core\Clousure;

use App\Model\Admin\Acount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Web\UserRequestTrait;

use DateTime;

class TableController extends Controller
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
    public function index(Request $request)
    {
        $object = new Table();
        $object->name = trim($request->input('key'));
        $object->description = trim($request->input('key'));
        $object->active = $request->input('active');

        $limit = $request->input('limit');
        if (!$limit || $limit === 'undefined') {
            $limit = 5;
        }
        $sort = $request->input('sort');
        if (!$sort || $sort === 'undefined') {
            $sort = 'ASC';
        }
        $page = $request->input('page');
        if (!$page || $page === 'undefined') {
            $page = '0';
        }
        $page = intval($page) + 1;


        // Obtiene las mesas del salon
        // return response()->json($request->input());
        $tables = Table::where('store_id', $request->user()->store()->id)
            ->name($object->name)
            ->name($object->description)
            ->active($object->active)
            ->orderBy('id',  $sort)
            ->paginate($limit, ['*'], '', $page);

        return response()->json($tables);
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

    /**
     * @OA\Get(
     *      path="/table/{id}/serviceopen",
     *      operationId="serviceopen",
     *      tags={"Table"},
     *      summary="Evalua si una tabla tiene Servico y lo retorna",
     *      description="Evalua si una tabla tiene Servico y lo retorna",
     *      @OA\Parameter(
     *          name="id",
     *          description="Table id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function tableServiceOpen(Request $request, $id)
    {
        $table = Table::find($id);
        return response()->json($table->tableServiceOpen());
    }

    // Crea un nuevo servico
    public function tableServiceSave(Request $request)
    {

        $request->request->add($request->input('params'));

        $table = Table::find($request->input('params')['table_id']);

        // Miramos que no tenga mas servicis
        // por precausións
        $services = Service::where('table_id', $request->input('params')['table_id'])
            ->where('open', 1)
            ->get();

        if ($services->count()) {
            return response()->json(['message' => 'NO_MULTI_SERVERS'], 404);
        }

        $service = new Service();
        $today = new DateTime();
        $today = $today->format('Y-m-d H:i:s');
        $request->request->add(['date_open' => $today]);


        $cousure = Clousure::where('store_id', $table->store_id)
            ->where('open', 1)
            ->get();

        if ($cousure->count() <> 1) {
            return response()->json(['message' => 'No hay una Labor en curso, debes habrir una nueva'], 404);
        }
        $request->request->add(['rel_clousure_id' => $cousure->first()->id]);

        $max_number = Service::where('tables.store_id', $request->user()['rel_store_id'])
            ->leftJoin('tables', 'tables.id', 'services.table_id')
            ->get()->max('number');

        $request->request->add(['number' => $max_number + 1]);

        return response()->json($service::create($request->input()));
    }

    public function tableServiceClose(Request $request)
    {


        $table = Table::find($request->input('params')['table_id']);
        $orders = Order::ordersStatusOneService($table->store_id, $request->input('params')['service_id']);

        if (!count($orders)) {
            $service = Service::where('table_id', $table->id)
                ->where('open', 1)
                ->get()->first();

            $today = new DateTime();
            $today = $today->format('Y-m-d H:i:s');

            $service->description = '';
            $service->open = 0;
            $service->date_close = $today;
            $service->save();

            return response()->json($service);
        } else {
            // no podemos hacer el cierres
            // a menos que sea obligado que si
            if ($request->input('params')['service_close'] === 'true') {
                //1. pagamos todas las order_product
                $orders_product_paid = Order::orderProductStatusOneServicePaid($table->store_id, $request->input('params')['service_id']);

                $order_paid = Order::ordersStatusOneServicePaid($table->store_id, $request->input('params')['service_id']);

                $service = Service::where('table_id', $table->id)
                    ->where('open', 1)
                    ->get()->first();

                $today = new DateTime();
                $today = $today->format('Y-m-d H:i:s');

                $service->description = '';
                $service->open = 0;
                $service->date_close = $today;
                $service->save();

                return response()->json($service);
            } else {
                return response()->json(['message' => 'NO_SERVER_CLOSE'], 404);
            }
        }
    }
}
