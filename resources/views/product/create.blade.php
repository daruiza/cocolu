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
												<ul class="nav nav-tabs" id="myTab" role="tablist">
													<li class="nav-item">
    													<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
													    {{ __('messages.Basic') }}
														</a>
													</li>
													<li class="nav-item">
												    	<a class="nav-link" id="component-tab" data-toggle="tab" href="#components" role="tab" aria-controls="components" aria-selected="false">{{ __('messages.Components') }}</a>
													</li>
												</ul>
												<div class="tab-content" id="myTabContent">
													<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
														@include('product.form')
													</div>
													<div class="tab-pane fade show" id="components" role="tabpanel" aria-labelledby="component-tab">
														<div class="inputs_ingredients"></div>
														<div class="col-md-12">
															<div class="row">
															<div class="col-md-6"></div>	
															<div class="col-md-6 col-md-offset-11" data-toggle="tooltip" data-original-title="{{__('form.AddIngredients')}}" style="text-align: right;">
																<a href="javascript:product.addIngredient()" class="site_title" style="text-decoration: none">
																	{{__('form.AddComponents')}} <i class="fas fa-plus"></i>
																</a>
																</div>
															</div>
														</div>
													</div>
												</div>												
											{!! Form::close() !!}
										</div>

										{!! Form::select('products',$product->productsArrayCategoryDefault(),null,['id'=>'products','class'=>'form-control','style'=>'display:none']) !!}
											
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

{!! Form::hidden('input_placeholder_volume', __('messages.Volume') ) !!}
{!! Form::hidden('input_placeholder_group', __('messages.Group') ) !!}

@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('js/chosen.jquery.min.js') }}"></script>	
	<script type="text/javascript" src="{{ asset('js/entity/product.js') }}"></script>
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
		$('[data-toggle="tooltip"]').tooltip();
	</script>
@endsection

@section('style')	
	<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet"> 
	<link href="{{ asset('css/chosen.min.css') }}" rel="stylesheet"> 
	<style type="text/css">
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
		
		.chosen-container-multi .chosen-choices,
		.chosen-container .chosen-single{
			height: calc(2.25rem + 2px);
    		padding: .375rem .75rem;
    		background-image: -webkit-gradient(linear,left top,left bottom,color-stop(1%,transparent),color-stop(15%,transparent));
    		background-image: linear-gradient(transparent 1%,transparent 15%);
    		border: 1px solid #ced4da;
    		border-radius: .25rem;
		}

		.chosen-container .chosen-single > div{
			top: 6px;
		}


		.content-add-ingredient{
			padding: 10px;
    		border: 1px solid #ced4da;
		}
		.tab-content{
			margin-top: 10px;
		}
	</style>
@endsection
