<?php

namespace App\Http\Controllers\Web;

use App\Model\Core\Invoice;
use App\Model\Core\Clousure;
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
    public function index(Request $request)
    {   
        $invoice = new Product();
        $invoice->number = $request->input('number');
        $invoice->date = $request->input('date');
        $invoice->provider = $request->input('provider');
        $invoice->clousure = $request->input('clousure');
        
        $invoices = Invoice::
            select('invoices.*')
            ->where('invoices.store_id',Auth::user()->store()->id)
            ->number($invoice->number)
            ->date($invoice->date)
            ->provider($invoice->provider)
            ->clousure($invoice->clousure)
            ->leftJoin('clousures','clousures.id','invoices.clousure_id')            
            ->orderBy('invoices.id','DESC')
            ->paginate(16);
        
        return view('invoice.index',compact('invoices','invoice'))->with('data', []);
        
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
        $array = $this->validatorInvoice($request);
        //iniciamos el almaceniemto de la información
        //creación o actualización de proveedor
        $provider = Provider::select()
            ->where('number','LIKE',explode('-',$request->input('number_provider'))[0])
            ->where('store_id',Auth::user()->store()->id)
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
            ->where('store_id',Auth::user()->store()->id)
            ->where('provider_id',$provider->id)
            ->get();
        if(empty($invoice->first())){

            $invoice = new Invoice();
            $invoice->storeInvoice($request,$provider->id); 

            //relación de detalles
            foreach ($array as $key => $value) {

                $value['invoice_id'] = $invoice->id;
                $value['product_id'] = $value['product'];            
                $invoiceproduct = new InvoiceProduct();
                $invoiceproduct->storeInvoiceProduct($value);            

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
                $product  = Product::find($value['product']);
                $product->editProductStockUpBuyPrice([
                    'volume'=>$value['volume'],
                    'buy_price'=>$value['price']
                ]);                
                
            }
            Session::flash('success', [['EnvoiceSaveOk',$invoice->first()->number]]);            
            return Redirect::back();
        }else{
            Session::flash('danger', [[
                'NumberEnvoiceNowExist',$request->input('number_invoice')
            ]]);            
            return Redirect::back()->withInput($request->input());
        }
        
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
    public function edit(Request $request,$id)
    {
        //en caso de pasar el filtro se procede a editar
        $invoice = Invoice::find($request->input('id'));        
        //solo se puede editar una factura dentro del mismo clousure
        if($invoice->clousure()->first()->id != Auth::user()->store()->clousureOpen()->id){
            Session::flash('danger', [[
                'EnvoiceNotEdit',$invoice->number
            ]]);            
            return Redirect::back();
        }

        $clousure = new Clousure();            
        return view('invoice.edit',compact('invoice','clousure'))->with('data', []); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $array = $this->validatorInvoice($request);
        //1. devolvemos la factura
        $invoice = Invoice::select()
            ->where('id',$id)            
            ->get();

        if(!empty($invoice->first())){
            //relación de detalles
            foreach ($invoice->first()->products()->get() as $key => $value) {

                $today = new DateTime();
                $today = $today->format('Y-m-d H:i:s'); 

                //creación de relación de stock
                if($value['price']){
                    $stock = new Stock();
                    $stock->storeStockProduct(array(
                        'product_id' =>  $value['product_id'],
                        'volume' =>  $value['volume'],
                        'shift' =>  0,
                        'date' =>  $today
                    ));
                }

                //actualización de cantidad en producto
                //modificamos el buy price, operacion contable
                $product  = Product::find($value['product_id']);
                $product->editProductStockDownBuyPrice([
                    'volume'=>$value['volume'],
                    'buy_price'=>$value['price']
                ]);      
                
            }
        }else{
            Session::flash('danger', [[
                'NumberEnvoiceNoExist',$request->input('number_invoice')
            ]]);            
            return Redirect::back()->withInput($request->input());
        }

        //1. 
        //eliminar la factura
        $invoice->first()->delete();

        //2. guardamos la factura nueva
        $this->store($request);

        Session::flash('success', [['EnvoiceEditOk',$invoice->first()->number]]);            
        return redirect('invoice');
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


    private function validatorInvoice(Request $request)
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

        return $array;
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
