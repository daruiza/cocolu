@extends('layouts.app')

@section('template')
    
@endsection

@section('content')
<div class="container">
   <div class="flex-center position-ref full-height">
        <div class="col-md-12">
            <div class="content">
               <div class="row">

               	<div class="col-md-3 col-lateral-table">
					<div class="col-md-12">
            		<div class="card card-menu-table">
	                    <div class="card-header">{{ __('form.InvoiceCreate') }}</div>
	                    <div class="card-body">
	                    	<div class="container">
		                    	<div class="row">
			                    	<div class="col-md-12">
			                    		Descripcion de factura de compra
			                    	</div>
			                    </div>	                    			        		
	                    	</div>	        		
	                    </div>	                    
	                </div>
					</div>
												
					<div class="col-md-12">
						<div class="col-md-12 img-container">
							{{ Html::image('users/'.\Auth::user()->id.'/supports/default.png','Imagen no disponible',array('id'=>'img_support_img','style'=>'width: 100%; border:2px solid #ddd;border-radius: 0%;','onclick'=>'$("#img_support").trigger("click")'))}}
							@if ($errors->has('image'))		                        	
								<span class="invalid-feedback" style="display: block;">
									<strong>{{ $errors->first('image') }}</strong>
								</span>
							@endif
						</div>
						{!! Form::label('support',__('messages.Support'),['class'=>'col-sm-12 col-form-label text-md-center']) !!}
						
					</div>											
																	
            	</div>

            	<div class="col-md-9">
            		@include('layouts.alert')

            		<div class="card">
                    	<div class="card-header">{{ __('form.createInvoice') }}</div>
	                    <div class="card-body">
							<div class="content">
								<div class="row">										
									<div class="col-md-12">
										{!! Form::open(['enctype' => 'multipart/form-data','id'=>'form-invoice','route'=>['invoice.store'],'method'=>'POST']) !!}

			                    			{!!Form::hidden('store-id', Auth::user()->store()->id)!!}
			                    			@include('invoice.form')

			                    		{!! Form::close() !!}
									</div>
									
									{!! Form::select('products',$product->productsArrayCategoryDefault(),null,['id'=>'products','class'=>'form-control','style'=>'display:none']) !!}
									
									
								</div>
							</div>
						</div>
					</div>
            	</div>

               </div>
           </div>
       </div>
   </div>
</div>

{!! Form::hidden('input_placeholder_volume', __('messages.Volume') ) !!}
{!! Form::hidden('input_placeholder_price', __('messages.Price') ) !!}

@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('js/chosen.jquery.min.js') }}"></script>	
	<script type="text/javascript" src="{{ asset('js/entity/invoice.js') }}"></script>
	<script type="text/javascript"> 
		$('#img_support').change(function(e) {
	    	var file = e.target.files[0],
		    imageType = /image.*/;
		    
		    if (!file.type.match(imageType))
		    return;
		  
		    var reader = new FileReader();
		    reader.onload = function(e) {
		    	var result=e.target.result;
		    	$('#img_support_img').attr("src",result);
	   	 	}
	    reader.readAsDataURL(file);
    	});

    	$('#img_provider').change(function(e) {
	    	var file = e.target.files[0],
		    imageType = /image.*/;
		    
		    if (!file.type.match(imageType))
		    return;
		  
		    var reader = new FileReader();
		    reader.onload = function(e) {
		    	var result=e.target.result;
		    	$('#img_provider_img').attr("src",result);
	    	}
	    reader.readAsDataURL(file);
    	});
	</script>
@endsection

@section('style')	
	<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet"> 
	<style>
		#form-invoice .form-group.row{
			border: 1px solid rgba(0,0,0,.125);
    		border-radius: .25rem;    
    		padding-bottom: 1.25em;
		}

		#form-invoice h5{
			text-align: center;
		}
	</style>
@endsection