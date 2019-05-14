<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use DB;

class Product extends Model
{
    protected $fillable = ['id','name','price','buy_price','volume','critical_volume','description','image1','image2','image3','order','label','active','unity_id','store_id'];

    public function scopeName($query,$name){
        if($name){
            return $query->where('name','LIKE',"%$name%");
        }
    }

    public function scopeActive($query,$active){        
        
        if(!empty($active) || $active == "0"){            
            return $query->where('active',intval($active));
        }                
    }

    public function scopeCategory($query,$category){
        if($category){
            return $query
            ->select('products.*')
            ->leftJoin('category_product','category_product.product_id','products.id')
            ->where('category_product.category_id',$category);
        }
    }

    //a pruduct belongs a store    
    public function store(){
        return $this->belongsTo(Store::class);
    }

    //a pruduct belongs a store    
    public function unity(){
        return $this->belongsTo(Unity::class);
    }

    //a product may have many stocks
    public function stocks(){
        //no usa el namespace
        return $this->hasMany(Stock::class);
    }

    public function categories(){
        //reutiliza el namespace
        return $this->belongsToMany(Category::class);
    }

    public function orders(){
        //reutiliza el namespace
        return $this->belongsToMany(Order::class);
    }

    public function products(){
        //reutiliza el namespace
        //return $this->belongsToMany(Product::class,'product_id','id');
        return \DB::table('product_product')           
            ->where('ingredient_id',$this->id)
            ->where('store_id',$this->store_id)
            ->orderBy('id','ASC')
            ->get();
    }

    //llamado a los ingredientes de un producto
    public function ingredients(){
        //reutiliza el namespace
        //return $this->hasMany(Product::class,'ingredient_id','id');
        return \DB::table('product_product') 
            ->select('product_product.id','product_product.ingredient_id','product_product.product_id','product_product.volume as volume_product','product_product.group','products.name as product','products.volume','unities.name as unity')       
            ->leftJoin('products','products.id','product_product.ingredient_id')
            ->leftJoin('unities','unities.id','products.unity_id')
            ->where('product_id',$this->id)
            ->orderBy('id','ASC')
            ->get();            
    }

    public function updateProduct(Request $request){

        if(!empty($request->file('image1'))){

            $this->validatorImage(['image1'=>$request->file('image1')])->validate();

            if($request->file('image1')->isValid()){

                $destinationPath = 'users/'.Auth::user()->id.'/products';
                $extension = $request->file('image1')->getClientOriginalExtension(); // getting image extension
                $fileName_image = rand(1,9999999).'.'.$extension; // renameing image
                $request->file('image1')->move($destinationPath, $fileName_image);
                chmod('users/'.Auth::user()->id.'/products/'.$fileName_image, 0777);

                //$request->request->add(['image1' => $fileName_image]);
                $this->image1 = $fileName_image;
            }
        }

        $this->name = $request->input('name');
        $this->price = $request->input('price');
        $this->description = $request->input('description');
        $this->critical_volume = $request->input('critical_volume');
        $this->order = $request->input('order');
        $this->active = $request->input('active');
        
        $this->save();
        
        //categorias
        DB::table('category_product')->where('product_id',$this->id)->delete();
        foreach (explode(',',$request->input('category_ids')) as $key => $value) {            
            DB::table('category_product')->insert(
                [
                    'category_id' => $value,
                    'product_id' => $this->id
                ]
            );
        }

        //product_ingredient
         
        DB::table('product_product')->where('product_id',$this->id)->delete();
        $array = array();
        foreach($request->input() as $key=>$value){
            if(strpos($key,'item_') !== false){
                $vector=explode('_',$key);
                $n=count($vector);
                $id_item = end($vector);
                $array[$id_item][$vector[$n-2]] = ucfirst($value);
            }
        }
        
        foreach ($array as $key => $value) {
            if(!empty($value['volume'])){
                DB::table('product_product')->insert(
                    [
                        'product_id' => $this->id,
                        'ingredient_id' => $value['product'],
                        'volume' => $value['volume'],
                        'group' => $value['group']
                    ]
                );
            }
            
        }
        
    }

    //llamado al objrto producto de un ingrediente
    public function ingredientsAsProduct(){
        //reutiliza el namespace
        //return $this->hasMany(Product::class,'ingredient_id','id');
        return \DB::table('products')
            ->leftJoin('product_product','product_product.product_id','products.id')      
            ->where('product_id',$this->id)
            ->orderBy('products.id','ASC')
            ->get();            
    }

    static function getProducts(){
        return Product::where('store_id',Auth::user()->store()->id)
            ->where('products.active',1);            
    }

    static function productsArray(){
        $products = Array();
        $products_array = Product::getProducts()->orderBy('products.name','ASC')->get();        
        foreach ($products_array as $key => $value) {
            $products[$value->id] = $value->name.' - ['.$value->unity->name.']';
        }
        return $products;
    }

    //todas las categorias de los productos de una tienda
    public function categoryArrayAll(){
    
        $array=Array();        
        $category_array = Category::select('id','name')
            ->where('categories.rel_store_id',Auth::user()->store()->id)
            ->orderBy('categories.name','ASC')->get();
        foreach ($category_array as $key => $value) {
            $array[$value->id] = $value->name;
        }
        return $array;

    }

    //funcion para hallar las categorias de un producto
    public function categoryArray(){        
        $array = Array();
        $category_array = CategoryProduct::select('category_id')            
            ->where('category_product.product_id',$this->id)
            ->orderBy('category_id','ASC')->get();
        foreach ($category_array as $key => $value) {
            $array[] = $value->category_id;
        }        
        return $array;

    }

    static function productsArrayCategoryDefault(){
        $products = Array();
        $products_array = Product::getProducts()
            ->leftJoin('category_product','products.id','product_id')
            ->where('category_product.category_id',1)
            ->orderBy('products.name','ASC')->get();                
        foreach ($products_array as $key => $value) {
            $products[$value->product_id] = $value->name.' - ['.$value->unity->name.']';
        }
        return $products;
    }

    static function productsArrayCategoryAll(){
        $products = Array();
        $products_array = Product::getProducts()
            ->orderBy('products.name','ASC')->get();

        foreach ($products_array as $key => $value) {            
            $products[$value->id] = $value->name.' - ['.$value->unity->name.']';
        }
        return $products;
    }

    static function productstByStore(){
        
        return Product::getProducts()
            ->select('products.*','categories.name as category','categories.order as order_category')
            ->rightJoin('category_product','products.id','product_id')
            ->leftJoin('categories','category_product.category_id','categories.id')            
            ->where('categories.active',1)
            ->where('categories.category_id',"<>",0)
            ->orderBy('categories.order','ASC')
            ->orderBy('products.order','ASC')
            ->get();
    }

    public function categories_toString(){
        $string = "";
        foreach ($this->categories()->get() as $key => $value) {
            $string  = $string.$value->name." - ";
        }
        return substr($string,0,-3);
    }

    public function critical_volume_calc(){
        if($this->critical_volume){
            if($this->volume <= $this->critical_volume) return true;
            return false;
        }        
        return false;        
    }

    public function editProductStock($data,$opt=false){
        
        if(!$opt){
            //decrementar
            if($this->volume){
                if(array_key_exists('volume',$data))$this->volume = $this->volume - $data['volume'];    
                $this->save();
            }
        }else{
            //incrementar
            if($this->buy_price){
                if(array_key_exists('volume',$data))$this->volume = $this->volume + $data['volume'];    
                $this->save();
            }
        }
                
    }

    public function editProductStockUp($data){
        if($this->buy_price){
            if(array_key_exists('volume',$data))$this->volume = $this->volume + $data['volume'];    
            $this->save();
        }        
    }

    public function editProductStockUpBuyPrice($data){
        if($this->buy_price){
            //actualización de costo
            if(array_key_exists('buy_price',$data)){
                //actualización d eprecio de compra
                $old_cost = $this->volume * $this->buy_price;
                $new_cost = intval($data['buy_price']);                
                $this->buy_price = ($old_cost+$new_cost)/($this->volume+$data['volume']);
            }
            $this->editProductStockUp($data);            
        }   
    }

    public function editProductStockDown($data){
        if($this->buy_price){
            if(array_key_exists('volume',$data))$this->volume = $this->volume - $data['volume'];    
            $this->save();
        }        
    }

    public function editProductStockDownBuyPrice($data){
        if($this->buy_price){
            //actualización de costo
            if(array_key_exists('buy_price',$data)){
                //actualización d eprecio de compra
                $old_cost = $this->volume * $this->buy_price;
                $new_cost = intval($data['buy_price']);                
                $this->buy_price = ($old_cost-$new_cost)/($this->volume-$data['volume']);
            }
            $this->editProductStockDown($data);            
        }   
    }

    //aumenta la cantidad de productos, usada en la mifificacion d euna orden
    public function editProductStockIngredient($data,$opt=false){
        
        if(!$opt){
            //decrementar
            //consultamos el volumen
            $relation = \DB::table('product_product')           
                ->where('id',$data['rel_id'])
                ->get()
                ->first();
            if($this->volume){
                $this->volume = $this->volume - $relation->volume * $data['volume_product'];    
                $this->save();
            }
        }else{
            //incrementar
            //consultamos el volumen
            $relation = \DB::table('product_product')           
                ->where('id',$data['rel_id'])
                ->get()
                ->first();
            if($this->volume){
                $this->volume = $this->volume + $relation->volume * $data['volume_product'];    
                $this->save();
            }       
        }
               
    }

    //aumenta el stock de productos, usada en la mifificacion d euna orden
    public function editProductStockIngredientUp($data){
        //consultamos el volumen
        $relation = \DB::table('product_product')           
            ->where('id',$data['rel_id'])
            ->get()
            ->first();
        if($this->volume){
            $this->volume = $this->volume + $relation->volume * $data['volume_product'];    
            $this->save();
        }       
    }

    //usada en homeController para chart pie
    static function productByClousure(Clousure $clousure){
        $products_array = array();
        $products_array['labels'] = array();
        $products_array['data'] = array();
        //consultamos las ordenes pagas
        $products = Order::select('products.name',
        \DB::raw('SUM(order_product.volume) as product_volume'))
        ->leftJoin('services','orders.service_id','services.id')
        ->leftJoin('clousures','services.rel_clousure_id','clousures.id')        
        ->leftJoin('order_product','orders.id','order_product.order_id')
        ->leftJoin('products','order_product.product_id','products.id') 
        ->where('clousures.id',$clousure->id)
        ->groupBy('products.id')      
        ->get();    
        foreach ($products as $key => $product) {
            $products_array['labels'][] = $product->name;                    
            $products_array['data'][] = $product->product_volume;
        }    
        return $products_array;
    }

    public function validateAcount(){
        //verificación de cuenta
        $products = Product::where('store_id',Auth::user()->store()->id)->count();        
        if($products+1 > Auth::user()->acount()->first()->products)return true;
        return false;    
    }

    protected function validatorImage(array $data)
    {        
        return Validator::make($data, [
            'image1'=>'
                required|
                mimes:jpeg,bmp,png|
                dimensions:max_width=700,max_width=700|
                dimensions:min_width=64,min_width=64',            
        ]);
    }
    
}
