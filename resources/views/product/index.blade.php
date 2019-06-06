@extends('layouts.app')

@section('template')		          	
@endsection

@section('content')
<div class="flex-center position-ref full-height container">    
<div class="container">
    <div class="row">        	
    	<div class="col-md-3 col-lateral-table">
            <div class="col-md-12">
            <div class="card card-menu-table">
                <div class="card-header">{{ __('form.ProductIndex') }}</div>
                <div class="card-body">
                    <div class="container products-table">
                        <div class="row">								
                        </div>                                                  
                    </div>                  
                </div>                            
            </div>
            </div>

            <div class="col-md-12">
            <div class="card card-menu-table">
                <div class="card-header">{{ __('form.ProductOptions') }}</div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                @include('layouts.options_page',['model'=>'Products'])
                            </div>
                        </div>                                                  
                    </div>                  
                </div>                            
            </div>
            </div>

        </div>   

    	<div class="col-md-9">            		
    		@include('layouts.alert')
    		<div class="card">
                <div class="card-header">{{ __('form.indexProduct') }}</div>
                <div class="card-body">
                	<div class="container">
                    	<div class="row">
                            
                            <div class="col-md-12">
                                <div class="page-header">

                                    {!! Form::model($product,['enctype' => 'multipart/form-data','id'=>'form-product','route'=>['product.index'],'method'=>'GET']) !!}
                                        <div class="form-group form-search">                              
                                            {{Form::text('name',null,['class'=>'form-control','placeholder'=>__('messages.Name')])}}
                                        </div>
                                        <div class="form-group form-search">                              
                                            {!! Form::select('category',$product->categoryArrayAll(),null,['class'=>'form-control','placeholder' => __('form.Category')]) !!}
                                        </div>

                                        <div class="form-group form-search">                              
                                            {!! Form::select('active',[__('form.Inactive'),__('form.Active')],null,['class'=>'form-control','placeholder'=>__('form.Status')]) !!}
                                        </div>
                                        
                                        <div class="form-group form-search">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    {{Form::close()}}

                                    {!! Form::select('products',$product->productsArray(),null,['id'=>'products','class'=>'form-control','style'=>'display:none']) !!}
                                    
                                </div>
                                
                            </div>

	                    	<div class="col-md-12 m-b-md table-container">
	                    		<div class="row table-header">
                                    <div class="col-md-3">{{ __('messages.Name') }}</div>
                                    <div class="col-md-2">{{ __('messages.Price') }}</div>
                                    <div class="col-md-2">{{ __('messages.Buy_Price') }}</div>
                                    <div class="col-md-2">{{ __('messages.Volume') }}</div>
                                    <div class="col-md-3">{{ __('form.Categories') }}</div>
                                </div>   
		                    	@foreach($products as $key => $value)                                        
		                    		<div class="row object-product 
                                        @if($key%2) @else row-impar @endif
                                        @if($value->active)  @else row-no-active @endif">
                                        {{ Form::hidden('product-id', $value->id) }}
										<div class="col-md-3">{{$value->name}} - [{{$value->unity->name}}]</div>
                                        <div class="col-md-2">${{number_format($value->price)}}</div>
                                        <div class="col-md-2">${{number_format($value->buy_price)}}</div> 
                                        <div class="col-md-2 
                                        @if($value->critical_volume_calc()) critical_volume  @endif"
                                        @if($value->critical_volume_calc()) 
                                            data-toggle="tooltip" 
                                            title="{{__('messages.CriticalVolume').' '.number_format($value->critical_volume)}}!"
                                        @endif >{{number_format($value->volume)}}
                                        </div> 
                                        <div class="col-md-3">{{$value->categories_toString()}}</div>
									</div>										
		                    	@endforeach
	                    	</div>
                            {{ $products->appends([
                                'name'=>$product->name,
                                'category'=>$product->category,
                                'active'=>$product->active
                                ])
                                ->links() }}
	                    </div>                   			        		
                	</div>
            	</div>
            </div>
		</div>
		
	</div>
</div>
</div>

@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/entity/product.js') }}"></script>
    <script type="text/javascript">
        product.selectObject('object-product','selected-object');
        //product.selectTable('object-product','selected-object');
        function product_show_submit(id){
            if($("#"+id+" input[name=id]").val() !== ""){
                $('#'+id)[0].submit();
                return true;
            }            
            $('#modal-alert .content-text').html("{{ __('messages.ProductSelectNone') }}");
            $("#modal-alert").modal('show');
            return false;           
        }

        function product_edit_submit(id){
            if($("#"+id+" input[name=id]").val() !== ""){
                $('#'+id)[0].submit();
                return true;
            }
            $('#modal-alert .content-text').html("{{ __('messages.ProductSelectNone') }}");
            $("#modal-alert").modal('show');
            return false;           
        }

        function product_destroy_submit(id){                      

            if($("#"+id+" input[name=id]").val() !== ""){
                $('#modal-confirm .submit').attr('form',id);
                $('#modal-confirm .content-text').html("{{ __('messages.ConfirmOption') }}");
                $('#modal-confirm').modal('show');              
                return false;               
            }
            $('#modal-alert .content-text').html("{{ __('messages.ProductSelectNone') }}");
            $("#modal-alert").modal('show');
            return false;        

        }

        function product_editstock_submit(id){          
            if($("#"+id+" input[name=id]").val() !== ""){
                $('#'+id)[0].submit();
                return true;
            }
            $('#modal-alert .content-text').html("{{ __('messages.ProductSelectNone') }}");
            $("#modal-alert").modal('show');
            return false; 
        }
        /*
        function product_purchaseorder_submit(id){          
            $('#'+id)[0].submit();
            return true;
        }
        */

        var products = document.getElementById("products");
        for(var i=0;i<products.childElementCount;i++){
            product.datos_products.push(products.options[i].innerHTML);
        }       
        $( "input[name='name']" ).autocomplete({
              source: product.datos_products
        });

        
        
    </script>   
@endsection

@section('style')	
	<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet"> 
    <link href="{{ asset('css/jquery-ui.min.autocomplete.css') }}" rel="stylesheet"> 
	<style type="text/css">

        .table-container{
            text-align: center;
        }

		.row-impar{
		    background-color: {{ json_decode(Auth::user()->store()->label,true)['table']['colorRow'] }};
		}

        .object-product{
            border: 1px solid {{ json_decode(Auth::user()->store()->label,true)['table']['colorRow'] }};
            padding-top: 2px;
            padding-bottom: 2px;
            margin-top: 2px;
            margin-bottom: 2px;
        }

        .object-product:hover{
            cursor:pointer;
        }

        .selected-object{
            background-color: {{ json_decode(Auth::user()->store()->label,true)['table']['selectTable'] }} !important;
        }

        .critical_volume{
            border: 2px solid red;
            background-color: #e47b7b;
        }

        form#form-product{
            display: flex;            
            align-items: center;
            justify-content: center;
        }

        .form-search{
            margin: 4px;
        }

        .page-header{
            margin: 10px;   
        }

        .table-header{
            border: 1px solid gainsboro;
            padding-top: 2px;
            padding-bottom: 2px;
            margin-top: 2px;
            margin-bottom: 2px;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .row-no-active{
            background: {{ json_decode(Auth::user()->store()->label,true)['table']['colorInactive'] }};
            color: {{ json_decode(Auth::user()->store()->label,true)['table']['colorRow'] }};
        }
        .selected-object{
            color: #212529
        }

        

	</style>	
@endsection
