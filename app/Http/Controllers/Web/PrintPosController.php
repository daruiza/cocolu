<?php

namespace App\Http\Controllers\Web;


use App\Model\Core\Table;
use App\Model\Core\Store;
use App\Model\Core\Order;
use App\Model\Core\City;
use App\Model\Core\Department;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

use DateTime;

class PrintPosController extends Controller
{
    public function printPos(Request $request)
    {
    	$table = Table::find($request->input('table_id'));        
        $service = $table->tableServiceOpen()->first();
        $store = Store::find($table->store_id);

    	$array = array();    	
        foreach($request->input() as $key=>$value){
            if(strpos($key,'status_paid') !== false){
                $vector=explode('-',$key);
                $n=count($vector);
                $id_item = $vector[$n-2];
                $array[$id_item][$vector[$n-3]]['order_id'] = $id_item;
                $array[$id_item][$vector[$n-3]]['order_product_id'] = end($vector);                    
            }
        }
        foreach ($array as $key => $value) {
            //$key es el id de order
            $order = Order::find($key);                    
        }

        

        try {            
            
            dd($array);

            //$connector = new WindowsPrintConnector("TM-T20");
            //$printer = new Printer($connector);
            $connector = new FilePrintConnector("/dev/usb/lp2");
            $printer = new Printer($connector);

            $printer->setJustification(Printer::JUSTIFY_CENTER);            
                        
            $printer->bitImage(EscposImage::load(
                'users/'.\Auth::user()->id.'/stores/'.$store->logo,
                false
                )
            );
            $printer->feed();

            $printer->text(strtoupper($store->name)."\n");            
            $printer->text(strtoupper($store->description)."\n");
            $printer->text(City::find($store->city)->name.' - '.Department::find($store->department)->name."\n");
            
            $printer->text(strtoupper($store->adress)."\n");
            $printer->feed();

            $printer->text("RESPONSABLE DE IVA\n");
            $printer->text("RANGOS DE FACTURACIÓN: E 1 HASTA E 500000\n");
            $printer->text("RESOLUCIÓN DIAN 18762014208677 DE 26-04-2019\n");                
            $printer->feed(2);
            
            $printer->text("____________________________________________\n");
            $printer->text("FACTURA DE VENTA: E ".$service->number."\n");
            $printer->text("FECHA:  ".$service->date_open."\n");
            $printer->text("____________________________________________\n");
            $printer->feed();

            $printer->setJustification(Printer::JUSTIFY_LEFT);
            
            $printer->setJustification(Printer::JUSTIFY_RIGHT);
            
            $printer->feed(2);
            $printer->cut();
            $printer->pulse();
            $printer->close();
        }catch (Exception $e) {

            $printer->text($e->getMessage() . "\n");
        }
    }
}
