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
		                    <div class="card-header">{{ __('form.ExpenseCreate') }}</div>
		                    <div class="card-body">
		                    	<div class="container">
			                    	<div class="row">
				                    	<div class="col-md-12">
				                    		Descripcion de cuenta de gasto apunto de crear
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
		                    <div class="card-header">{{ __('form.createExpense') }}</div>
		                    <div class="card-body">
								<div class="content">
									<div class="row">										
										<div class="col-md-8">
											{!! Form::model($expense,['enctype' => 'multipart/form-data','id'=>'form-expense','route'=>['expense.store'],'method'=>'POST']) !!}

				                    			{!!Form::hidden('store-id', Auth::user()->store()->id)!!}
				                    			@include('expense.form')

				                    		{!! Form::close() !!}
										</div>

										<div class="col-md-4">
										
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
											<!--
											<div class="col-md-12 button-submit">
												<button type="submit" class="btn btn-primary" form="form-expense">
													{{ __('messages.Send') }}
												</button>
											</div>
											-->
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
</script>

@endsection

@section('style')
<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet">
<style type="text/css">

</style>
@endsection