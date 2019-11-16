<?php

namespace App\Model\Core;

use App\Model\Core\Service;
use App\Model\Core\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Table extends Model
{
    protected $fillable = ['id','name','description','icon','label','order','active','store_id'];

    //una mesa pertenece a una tienda
    public function store(){
        return $this->belongsTo(Store::class);
    }

    //una tienda puede tener muchos servicios
    public function services(){        
        return $this->hasMany(Services::class);
    }

    public function storeTable($data){
        if(array_key_exists('name',$data))$this->name = $data['name'];
        if(array_key_exists('description',$data))$this->description = $data['description'];
        if(array_key_exists('icon',$data))$this->icon = $data['icon'];
        if(array_key_exists('label',$data))$this->label = $data['label'];
        if(array_key_exists('order',$data))$this->order = $data['order'];
        if(array_key_exists('active',$data))$this->active = $data['active'];
        if(array_key_exists('store_id',$data))$this->store_id = $data['store_id'];        
        $this->save();
    }

    public function validateAcount(){
        //verificación de cuenta
        $tables = Table::where('store_id',Auth::user()->store()->id)->count();        
        if($tables+1 > Auth::user()->acount()->first()->tables)return true;
        return false;    
    }
    
	
	public function tableServiceOpen(){				
		return Service::where('table_id', $this->id)
        ->where('open',1)
        ->get();		
	}

    public function tableOrderStatusOneOpen(){             
        $service = $this->tableServiceOpen()->first();
        if(!empty($service)){
            return Order::where('service_id', $service->id)
            ->where('status_id',1)
            ->get();          
        }        
        return collect();
    }

    public function tableOrderStatusOneTwoOpen(){             
        $service = $this->tableServiceOpen()->first();
        if(!empty($service)){
            return Order::where('service_id', $service->id)
            ->where(function($query){
                $query->where('status_id',1)//orden tomada
                ->orWhere('status_id',2);//orden lista para entregar
            })            
            ->get();            
        }

        return collect();
    }

    // Retorna el servicio con las ordenes y su valor total
    public function getOrderTotal(){
        $sum = 0;
        if($this->tableServiceOpen()->count()){
            $orders = Order::select('orders.*','order_status.name as status'
                ,\DB::raw('SUM(products.price*order_product.volume) as order_price'))
                ->leftJoin('order_status','order_status.id','orders.status_id')
                ->leftJoin('order_product','order_product.order_id','orders.id')
                ->leftJoin('products','products.id','order_product.product_id')
                ->where('service_id',$this->tableServiceOpen()->first()->id)
                ->where(function($query){
                    $query->where('status_id',1)//orden tomada
                    ->orWhere('status_id',2)//orden lista para entregar
                    ->orWhere('status_id',3)//orden paga
                    //->orWhere('status_id',4)//orden cerrada
                    ;})
                    ->where('order_product.status_paid',false)
                ->groupBy('orders.id')
                ->orderBy('orders.status_id','ASC')
                ->get();

            foreach($orders as $key => $order){
                $sum = $sum + $order->order_price;
            }        
        }
        
        return $sum;
    }

    public function icons()
    {
        return [
            'fas fa-users' =>__('form.SelectUsers'),
            'fas fa-beer' =>__('form.SelectBeer'),
            'fas fa-glass-martini' =>__('form.SelectMartini'),
            'fas fa-birthday-cake' =>__('form.SelectCake'),
            'fas fa-coffee'=>__('form.SelectCoffe'),
            'fas fa-dice-d6' => __('form.SelectDice'),
            'fas fa-feather' => __('form.SelectFeather'),
            'fas fa-heart' => __('form.Selectheart'),
            'fas fa-moon' => __('form.SelectMoon'),
            'fas fa-star' => __('form.SelectStar'),
            'fas fa-wine-glass' => __('form.SelectWineGlass'),
            'fas fa-flag' => __('form.SelectFlag'),
            'fas fa-fire' => __('form.SelectFire'),
            'fas fa-clipboard' => __('form.SelectClipboard'),
            'fas fa-bell' => __('form.SelectBell'),
            'fas fa-archive' => __('form.SelectArchive'),
            'fab fa-first-order-alt' => __('form.SelectOrder'),
            'fas fa-cloud' =>__('form.SelectCloud'),
            'fas fa-couch' => __('form.SelectCouch'),
        ];
    }	
	
}
