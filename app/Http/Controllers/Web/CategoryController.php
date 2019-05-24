<?php

namespace App\Http\Controllers\Web;

use App\Model\Core\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

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
        $category = new Category();
        $category->name = $request->input('name');
        $category->description = $request->input('description');        
        $category->active = $request->input('active');


        $categories = Category::            
            //where('active',1)
            where('rel_store_id',Auth::user()->store()->id)
            ->name($category->name)
            ->description($category->description)            
            ->active($category->active)            
            ->orderBy('id','ASC')
            ->get();            
        return view('category.index',compact('categories','category'))->with('data', []);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        $order_max = Category::select('order')->max('order')+1;        
        return view('category.create',compact('category','order_max'))->with('data', []);
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
            if(is_null($request->input['order'])){
                $request->request->add(['order' => Category::select('order')->max('order')+1]);            
            }
            $category = new Category();
            $request->request->add(['rel_store_id' => Auth::user()->store()->id]);            
            $category::create($request->input());
            Session::flash('success', [['CategoryCreateOk']]);
            return redirect('category');
        }  
        Session::flash('danger', [['CategoryCreateNOOk']]);
        return redirect('category');   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ModelCoreCategory  $modelCoreCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $category = Category::find($request->input('id'));        
        return view('category.show',compact('category'))->with('success', [[]])->with('data', []);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ModelCoreCategory  $modelCoreCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $category = Category::find($request->input('id'));                
        $order_max = Category::select('order')->max('order');                
        return view('category.edit',compact('category','order_max'))->with('data', []);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ModelCoreCategory  $modelCoreCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {                
        $this->validator($request->all())->validate();
        //validar store
        if(!Auth::user()->validateUserStore($request->input('store_id'))) {
          return Redirect::back()->with('danger', [['NO_STORE_OWNER']]);  
        }

        $category = Category::find($request->input('id'));
        $category->name=$request->input('name');
        $category->description=$request->input('description');
        $category->order=$request->input('order');
        $category->active=$request->input('active');
        $category->save();

        Session::flash('success', [['CategoryEditOk']]);
        return redirect('category');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ModelCoreCategory  $modelCoreCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
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
            'order' => '                
                numeric|                
                digits_between:1,10240',
            'description' => '
                max:64',            
            'active' => '
                required',
            
        ]);
    }
}
