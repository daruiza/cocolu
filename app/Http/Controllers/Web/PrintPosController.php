<?php

namespace App\Http\Controllers\Web;


use App\Model\Core\Table;
use App\Model\Core\Store;
use App\Model\Core\Order;
use App\Model\Core\Waiter;
use App\Model\Core\OrderProduct;
use App\Model\Core\Product;
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

        $waiter = Waiter::find($order->waiter_id);

        try {

            if(json_decode(\Auth::user()->store()->label,true)['print']['os']){
                $connector = new WindowsPrintConnector(
                    json_decode(\Auth::user()->store()->label,true)['print']['conn']);
                $printer = new Printer($connector);
            }else{
                $connector = new FilePrintConnector(
                    json_decode(\Auth::user()->store()->label,true)['print']['conn']);
                $printer = new Printer($connector);
            }

            $printer->setJustification(Printer::JUSTIFY_CENTER);         
                        
            $printer->bitImage(EscposImage::load(
                'users/'.\Auth::user()->id.'/stores/'.$store->logo,
                false
                )
            );
            $printer->feed();

            $printer->text(strtoupper($store->name)."\n");            
            $printer->text(strtoupper($store->nit)."\n");
            $printer->text(City::find($store->city)->name.' - '.Department::find($store->department)->name."\n");
            
            $printer->text(strtoupper($store->adress)."\n");
            $printer->feed();


            $printer->text(__('print.attended').": ".
                strtoupper($waiter->user()->first()->name)." ".
                strtoupper($waiter->user()->first()->surname));

            $printer->feed();
            $printer->feed();

            $printer->text(__('print.responsible')."\n");
            $printer->text(__('print.ranges').": E 1 ".__('print.until')." E 500000\n");
            $printer->text(__('print.bill')."\n");                
            $printer->feed(2);
            
            $printer->text("____________________________________________\n");
            $printer->text(__('print.bill').": E ".$service->number."\n");
            $printer->text(__('print.date').":  ".$service->date_open."\n");
            $printer->text("____________________________________________\n");
            $printer->feed();            
            $printer->feed();
            

            $line = sprintf("%1$'#2s "."%2$-12s"."%3$-12s"."%4$-10s".'%5$s',
                '#',                    
                __('print.article'),
                str_pad(__('print.quantity'),6," ",STR_PAD_BOTH),
                __('print.price'),
                'TOTAL');
            $printer->text($line);
             $printer->feed(1);
            $line = sprintf("%1$'_2s "."%2$-12s"."%3$-12s"."%4$-10s".'%5$s',
                '_',                    
                '__________',
                str_pad('________',6," ",STR_PAD_BOTH ),
                '______',
                '______');
            $printer->text($line);
            $printer->text("\n");

            $i=1;
            $sum=0;

            foreach ($array as $key => $value) {
                foreach ($value as $k => $v) {                    
                    $order_product = OrderProduct::find($v['order_product_id']);
                    $product = Product::find($order_product->product_id);
                    $line = sprintf('%1$02d '."%2$-16s"."%3$-6s"."$%4$-10s".'$%5$s',
                        $i,                    
                        strtoupper(substr($product->name,0,12)),
                        str_pad(strval($order_product->volume),6," ",STR_PAD_BOTH ),
                        number_format(round($order_product->price/1.19,2)),
                        number_format($order_product->volume*round($order_product->price/1.19,2))
                    );
                    $sum = $sum + $order_product->volume*round($order_product->price/1.19,2);
                    $printer->text($line);
                    $printer->text("\n");
                    $i++;
                }
            }
            $printer->feed(2);

            $line = sprintf("%1$30s: "."$%2$-5s",
                "SUBTOTAL:",
                number_format(round($sum),2)           
            );
            $printer->text($line);
            $printer->text("\n"); 
            
            $line = sprintf("%1$30s  "."$%2$-5.s",
                "IVA:",
                number_format(round($sum*0.19),2) 
            );  
            $printer->text($line);
            $printer->text("\n"); 
            
            $line = sprintf("%1$30s  "."$%2$-5s",
                "TOTAL:",
                number_format(round($sum*1.19),2) 
            );
            $printer->text($line);
            $printer->text("\n"); 
            
            $printer->feed(2);
            $printer->text(__('print.thankyou')."\n");
            $printer->text(strtoupper($store->description)."\n");

            $printer->cut();
            $printer->pulse();
            $printer->close();
        }catch (Exception $e) {
            //$printer->text($e->getMessage() . "\n");
            Session::flash('danger', [[$e->getMessage()]]);
            return redirect('table');    
        }

        //retornar        
        Session::flash('success', [['PrintOK']]);
        return redirect('table');
    }
}
