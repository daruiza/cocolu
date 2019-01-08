<?php

namespace App\Http\Controllers\Web;

use App\Model\Core\Product;
use App\Model\Core\Category;
use App\Model\Core\Stock;
use App\Model\Core\CategoryProduct;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Http\Traits\Web\ProductRequestTrait;

use DateTime;

class ProductController extends Controller
{

    use ProductRequestTrait;
    
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
        $products = Product::            
            where('active',1)
            ->orderBy('id','ASC')
            ->get();
        return view('product.index',compact('products'))->with('data', []);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        $category = new Category();
        return view('product.create',compact('product','category'))->with('data', []);
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
        //validar store
        if(Auth::user()->validateUserStore($request->input('store_id'))){
            
            if(!empty($request->file('image1'))){

                $this->validatorImage(['image1'=>$request->file('image1')])->validate();

                if($request->file('image1')->isValid()){

                    $destinationPath = 'users/'.Auth::user()->id.'/products';
                    $extension = $request->file('image1')->getClientOriginalExtension(); // getting image extension
                    $fileName_image = rand(1,9999999).'.'.$extension; // renameing image
                    $request->file('image1')->move($destinationPath, $fileName_image);
                    chmod('users/'.Auth::user()->id.'/products/'.$fileName_image, 0777);

                    $request->request->add(['image1' => $fileName_image]);
                }
            }

            $product = new Product();
            $product = $product::create($request->input());

            $category_product = new CategoryProduct();
            //relationship to category
            foreach (explode(',',$request->input('category_ids')) as $key => $value) {
                $category_product->category_id = $value;
                $category_product->product_id = $product->id;
                $category_product->save();
            }

            //relation to stock
            $stock = new Stock();
            $request->request->add(['product_id' => $product->id]);
            $request->request->add(['shift' => 1]);//entrada            
            $today = new DateTime();
            $today = $today->format('Y-m-d H:i:s');     
            $request->request->add(['date' => $today]);            
            $stock = $stock::create($request->input());

            Session::flash('success', [['ProductCreateOk']]);
            return redirect('product');
        }

        Session::flash('danger', [['ProductCreateNOOk']]);
        return redirect('product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Core\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        return 'mostrar';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Core\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return 'editar';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Core\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Core\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => '
                required|
                string|
                max:32',
            'description' => '
                max:64',       
            'order' => '                
                numeric|                
                digits_between:1,1024',
            'category_id' => '
                required',
            'active' => '
                required',
            
        ]);
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
