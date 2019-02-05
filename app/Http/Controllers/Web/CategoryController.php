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
    public function index()
    {
        $categories = Category::            
            where('active',1)
            ->where('rel_store_id',Auth::user()->store()->id)
            ->orderBy('id','ASC')
            ->get();            
        return view('category.index',compact('categories'))->with('data', []);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        return view('category.create',compact('category'))->with('data', []);
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
            return $this->index();

        }  
        Session::flash('danger', [['CategoryCreateNOOk']]);
        return $this->index();     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ModelCoreCategory  $modelCoreCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ModelCoreCategory $modelCoreCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ModelCoreCategory  $modelCoreCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelCoreCategory $modelCoreCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ModelCoreCategory  $modelCoreCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModelCoreCategory $modelCoreCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ModelCoreCategory  $modelCoreCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelCoreCategory $modelCoreCategory)
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
            'active' => '
                required',
            
        ]);
    }
}
