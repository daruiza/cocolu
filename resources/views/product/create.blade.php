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
	                    <div class="card-header">{{ __('form.ProductService') }}</div>
	                    <div class="card-body">
	                    	<div class="container">
		                    	<div class="row">
			                    	<div class="col-md-12">
			                    		Descripcion de cuenta de product apunto de crear
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
	                    <div class="card-header">{{ __('form.createProduct') }}</div>
	                    <div class="card-body">
							
							<div class="content">
								<div class="row">
									<div class="col-md-8">
										
										<div class="col-md-12">
											{!! Form::model($product,['enctype' => 'multipart/form-data','id'=>'form-product','route'=>['product.store'],'method'=>'POST']) !!}

												{!!Form::hidden('store_id', Auth::user()->store()->id)!!}
												@include('product.form')

											{!! Form::close() !!}
										</div>
											
									</div>
							
									<div class="col-md-4">
										
										<div class="col-md-12">
											<div class="col-md-12 img-container">
												{{ Html::image('users/'.\Auth::user()->id.'/products/default.png','Imagen no disponible',array('id'=>'img_prod_img','style'=>'width: 100%; border:2px solid #ddd;border-radius: 0%;','onclick'=>'$("#img_product1").trigger("click")'))}}
												
												@if($errors->has('image1'))                        	
													<span class="invalid-feedback" style="display: block;">
														<strong>{{ $errors->first('image1') }}</strong>
													</span>
												@endif

											</div>
											<div class="col-md-12 button-submit">
												<button type="submit" class="btn btn-primary" form="form-product">
													{{ __('messages.Send') }}
												</button>
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
        </div>
    </div>
</div>
@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('js/chosen.jquery.min.js') }}"></script>	
	<script type="text/javascript"> 
		$('#img_product1').change(function(e) {
	    	var file = e.target.files[0],
		    imageType = /image.*/;
		    
		    if (!file.type.match(imageType))
		    return;
		  
		    var reader = new FileReader();
		    reader.onload = function(e) {
		    	var result=e.target.result;
		    	$('#img_prod_img').attr("src",result);
		    }
		    reader.readAsDataURL(file);
	    });

	    $('.chosen-select').chosen();
		$('.chosen-container').width('100%');
		$("#category_id").chosen().change(function(event) {
			$('#category_ids').val($('#category_id').chosen().val());		    
		});
	</script>
@endsection

@section('style')	
	<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet"> 
	<link href="{{ asset('css/chosen.min.css') }}" rel="stylesheet"> 
	<style>
		select {
		  font-family: 'FontAwesome';
		}
		.button-submit{
			text-align: right;
			padding-right: 20px;
			margin-bottom: 20px;
		}
		.button-submit button{
			width: 100%;
			margin-top: 10%;
		}
		.chosen-container .chosen-container-multi{
			border: 1px solid #ccc !important;
			border-radius: 4px !important;
		}

		.chosen-container-multi .chosen-choices{
			background-color: #fff;
		    background-clip: padding-box;
		    border: 1px solid #ced4da;
		    border-radius: .25rem;
		    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
		    height: calc(2.25rem + 2px);
		    padding: .375rem .75rem;
		    font-size: 1rem;
		    line-height: 1.5;
		    color: #495057;
		    background-image: none;
		}
	</style>
@endsection
