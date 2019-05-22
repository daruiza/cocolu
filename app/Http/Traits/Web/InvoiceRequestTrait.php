<?php

namespace App\Http\Traits\Web;

use App\Model\Core\City;
use App\Model\Core\Product;
use Illuminate\Http\Request;
use App\Model\Core\Provider;

trait InvoiceRequestTrait
{
	
	//entrega los datos de los productos para realizar una factura de compra
    public function purchaseOrder(){
        
        //0. validaciones
        //No valida, solo entrega, luego el metodo de store valida

        //1. consultamos los productos - todos. tener en cuenta si no hay        
        $product = new Product();        
        if(!count($product->productsArrayCategoryAll())){
            Session::flash('info', [['PurchageOrderNoProducts']]);
            return redirect('product');
        }
        
        //2. consultamos los proveedores - todos
        $provider = new Provider();
        
        return view('invoice.create',compact('product','provider'))->with('data', []);
    }

    public function purchase(){

    }
	
}