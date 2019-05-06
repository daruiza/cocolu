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
                <div class="card-header">{{ __('messages.ProductIndex') }}</div>
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
                <div class="card-header">{{ __('messages.ProductOptions') }}</div>
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
                <div class="card-header">{{ __('messages.indexProduct') }}</div>
                <div class="card-body">
                	<div class="container">
                    	<div class="row">
                            <div class="col-md-12">
                                <div class="page-header">                                               
                                    {!! Form::model($product,['enctype' => 'multipart/form-data','id'=>'form-product','route'=>['product.index'],'method'=>'GET']) !!}
                                        <div class="form-group form-search">                              
                                            {{Form::text('name',null,['class'=>'form-control','placeholder'=>__('messages.name')])}}
                                        </div>
                                        <div class="form-group form-search">                              
                                            {{Form::text('category',null,['class'=>'form-control','placeholder'=>__('messages.category')])}}
                                        </div>
                                        
                                        <div class="form-group form-search">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    {{Form::close()}}
                                    
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
                                        @if($key%2) @else row-impar @endif">
                                        {{ Form::hidden('product-id', $value->id) }}
										<div class="col-md-3">{{$value->name}}</div>
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
            alert("{{ __('messages.ProductSelectNone') }}");
            return false;           
        }

        function product_edit_submit(id){
            if($("#"+id+" input[name=id]").val() !== ""){
                $('#'+id)[0].submit();
                return true;
            }
            alert("{{ __('messages.ProductSelectNone') }}");
            return false;           
        }

        function product_destroy_submit(id){          
            if(confirm("{{ __('messages.ProductConfirmDestroy') }}")){
                if($("#"+id+" input[name=id]").val() !== ""){
                $('#'+id)[0].submit();
                    return true;
                }
                alert("{{ __('messages.ProductSelectNone') }}");
                return false;
            }
            return false;
        }

        function product_editstock_submit(id){          
            if($("#"+id+" input[name=id]").val() !== ""){
                $('#'+id)[0].submit();
                return true;
            }
            alert("{{ __('messages.ProductSelectNone') }}");
            return false; 
        }
        /*
        function product_purchaseorder_submit(id){          
            $('#'+id)[0].submit();
            return true;
        }
        */

        
        
    </script>   
@endsection

@section('style')	
	<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet"> 
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

	</style>	
@endsection
