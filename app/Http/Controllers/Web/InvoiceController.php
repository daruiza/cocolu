<?php

namespace App\Http\Controllers\Web;

use App\Model\Core\Invoice;
use App\Model\Core\InvoiceProduct;
use App\Model\Core\Provider;
use App\Model\Core\Product;
use App\Model\Core\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Validator;

use App\Http\Traits\Web\InvoiceRequestTrait;

use DateTime;

class InvoiceController extends Controller
{
    use InvoiceRequestTrait;

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
        
        $this->validator($request->all())->validate();
        if(!Auth::user()->validateUserStore($request->input('store-id'))){            
            Session::flash('danger', [['NO_STORE_OWNER']]);
            return redirect('invoice/purchaseorder');
        }

        //preparacion de datos
        $array = array();
        foreach($request->input() as $key=>$value){
            if(strpos($key,'item_') !== false){
                $vector=explode('_',$key);
                $n=count($vector);
                $id_item = end($vector);
                $array[$id_item][$vector[$n-2]] = ucfirst($value);
            }
        }

        if(!count($array)){
            Session::flash('danger', [['NO_PRODUCT_ADD']]);
            //return redirect('invoice/purchaseorder')->withInput($request->input());            
            return Redirect::back()->withInput($request->input());
        }

        $flat = false;
        foreach ($array as $key => $value) {
            //value es un array
            if(empty($value['volume']))$flat = true;
            if(empty($value['price']))$flat = true;
            if(empty($value['product']))$flat = true;
        }

        if($flat){
            Session::flash('danger', [['NO_PRODUCT_ADD_VALUE_EMPTY']]);            
            return Redirect::back()->withInput($request->input());
        }

        //iniciamos el almaceniemto de la información

        //creación o actualización de proveedor
        $provider = Provider::select()
            ->where('number','LIKE',$request->input('number_provider'))
            ->get();
        if(empty($provider->first())){
            //creamos el nuevo proveedor
            $provider = new Provider();
            $provider->storeProvider($request);           

        }else{
            //actualizamos el proveedor
            $provider->first()->updateProvider($request);            
            $provider = $provider->first();
        }

        //creación de factura 
        $invoice = Invoice::select()
            ->where('number','LIKE',$request->input('number_invoice'))
            ->where('provider_id',$provider->id)
            ->get();
        if(empty($invoice->first())){
            $invoice = new Invoice();
            $invoice->storeInvoice($request,$provider->id); 
        }else{
            $invoice->first()->updateInvoice($request);            
            $invoice = $invoice->first();
        }
               

        //relación de detalles
        foreach ($array as $key => $value) {

            $value['invoice_id'] = $invoice->id;
            $value['product_id'] = $value['product'];
            $invoiceproduct = InvoiceProduct::select()
                ->where('invoice_id',$invoice->id)
                ->where('product_id',$value['product'])
                ->get();

            if(empty($invoiceproduct->first())){
                $invoiceproduct = new InvoiceProduct();
                $invoiceproduct->storeInvoiceProduct($value); 
            }else{                
                $invoiceproduct->first()->updateInvoiceProduct($value);            
                $invoiceproduct = $invoiceproduct->first();
            }           

            dd($value);

            $today = new DateTime();
            $today = $today->format('Y-m-d H:i:s');     

            //creación de relación de stock
            if($value['price']){
                $stock = new Stock();            
                $stock->storeStockProduct(array(
                    'product_id' =>  $value['product'],
                    'volume' =>  $value['volume'],
                    'shift' =>  1, 
                    'date' =>  $today
                ));
            }

            //actualización de cantidad en producto


            
            //modificamos el buy price, operacion contable
        }

        

        

        
        dd('va bien la vuelta');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'number_invoice' => '
                required|
                string|
                max:64',
            'number_provider'=>'
                required|
                string|
                max:64',
            'name_provider'=>'
                required|
                string|
                max:64',            
            'store-id' => '                
                required',
            
        ]);
    }
   
}
