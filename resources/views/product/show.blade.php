@extends('layouts.app')

@section('template')		          	
@endsection

@section('content')
	<div class="flex-center position-ref full-height container">    
	    <div class="container">
	        <div class="row">

	        	<div class="col-md-3">
	                <div class="card card-menu-table">
	                    <div class="card-header">{{ __('messages.ProductShow') }}</div>
	                    <div class="card-body">
	                        <div class="container product-show">
	                            <div class="row">                                
									<div class="col-md-12">
										{{ __('messages.Name') }} <b>{{$product->name}}</b>
									</div>
									<div class="col-md-12"> 
										{{ __('messages.Price') }} {{\Auth::user()->store()->currency}} <b>{{$product->price}}</b>
									</div>
									<div class="col-md-12"> 
										{{ __('messages.Price') }} {{\Auth::user()->store()->currency}} <b>{{$product->buy_price}}</b>
									</div>
									<div class="col-md-12"> 
										{{ __('messages.Volume') }} <b>{{$product->volume}}</b> {{$product->unity->name}}
									</div>
									<div class="col-md-12"> 
										{{ __('messages.CriticalVolume') }} <b>{{$product->critical_volume}}</b> {{$product->unity->name}}
									</div>
									<div class="col-md-12"> 
										{{ __('messages.Description') }} <b>{{$product->description}}</b> {{$product->description}}
									</div>
									<div class="col-md-12">
										<a class="dropdown-item" href="javascript: product_edit_submit('product-edit-form')">
                            				<i class="fas fa-cogs"></i>
                            				{{ __('options.edit') }}
                        				</a>
                        				{!! Form::open(array('id'=>'product-edit-form','route' =>['procuct.edit',$product->id] ,'method' =>'GET', 'onsubmit' =>'return validateForm()')) !!}
                            				{{ Form::hidden('id',$product->id) }}                            
                        				{!! Form::close() !!}
									</div>								
	                            </div>                                                  
	                        </div>                  
	                    </div>                            
	                </div>
	        	</div>	

	        	<div class="col-md-6">	        		
	                <div class="card card-menu-table">
	                    <div class="card-header">{{ __('messages.ProductDescription') }}</div>
	                    <div class="card-body">
	                        <div class="container services-table">
	                            <div class="row">                                
									<div class="col-md-12">historial de inventario</div>
									<div class="col-md-12">veces vendido</div>
									<div class="col-md-12">margen de ganancia</div>
	                            </div>                                                  
	                        </div>                  
	                    </div>                            
	                </div>
	        	</div>	

	        	<div class="col-md-3">	        		
	                <div class="card card-menu-table">
	                    <div class="card-header">{{ __('messages.ProductImages') }}</div>
	                    <div class="card-body">
	                        <div class="container services-table">
	                            <div class="row">                                
									<div class="col-md-12">
										{{ Html::image('users/'.\Auth::user()->id.'/products/'.$product->image1,'Imagen no disponible',array('id'=>'img_user_img','style'=>'width: 100%; border:2px solid #ddd;border-radius: 0%;'))}}
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
	<script type="text/javascript">
		function product_edit_submit(id){
            if($("#"+id+" input[name=id]").val() !== ""){
                $('#'+id)[0].submit();
                return true;
            }
            alert("{{ __('messages.ProductSelectNone') }}");
            return false;           
        }
	</script>
@endsection

@section('style')	
	<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet"> 
	<style type="text/css">
		.product-show{
			text-align: center;
		}
		.product-show .row > div{
			border-top: 1px solid rgba(0,0,0,.125);
			border-left: 1px solid rgba(0,0,0,.125);
			border-right: 1px solid rgba(0,0,0,.125);
		}
	</style>	
@endsection
