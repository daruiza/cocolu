<?php

namespace App\Http\Controllers\Web;


use App\Model\Core\Table;
use App\Model\Core\Order;


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

        dd($request->input());

        //$connector = new WindowsPrintConnector("TM-T20");
        //$printer = new Printer($connector);
        $connector = new FilePrintConnector("/dev/usb/lp2");
        $printer = new Printer($connector);
        $printer->text("Hello World!\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("jjiiji\n");
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $printer->text("jajaj\n");
        $printer->feed(2);
        $printer->cut();
        $printer->pulse();
        $printer->close();
    }
}
