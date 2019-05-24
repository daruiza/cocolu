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
	                    <div class="card-header">{{ __('form.TableService') }}</div>
	                    <div class="card-body">
	                    	<div class="container">
		                    	<div class="row">
			                    	<div class="col-md-12">
			                    		Descripcion de cuenta de mesero apunto de editar
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
	                    <div class="card-header">{{ __('form.editWaiter') }}</div>
	                    <div class="card-body">
							
							<div class="content">
								<div class="row">
									<div class="col-md-8">
										
										<div class="col-md-12">
											{!! Form::model($waiter,['enctype' => 'multipart/form-data','id'=>'form-waiter','route'=>['waiter.update',$waiter->id],'method'=>'POST']) !!}
												@csrf
			                    	 			{{ method_field('PATCH') }}
			                    	 			{!!Form::hidden('waiter_id', $waiter->id_waiter)!!}
												{!!Form::hidden('store_id', Auth::user()->store()->id)!!}
												@include('waiter.form_edit')
											{!! Form::close() !!}
										</div>
											
									</div>
							
									<div class="col-md-4">
										
										<div class="col-md-12">
											<div class="col-md-12 img-container">
												{{ Html::image('users/'.$waiter->id.'/profile/'.$waiter->avatar,'Imagen no disponible',array('id'=>'img_user_img','style'=>'width: 100%; border:2px solid #ddd;border-radius: 0%;','onclick'=>'$("#img_user").trigger("click")'))}}
												@if ($errors->has('image'))		                        	
													<span class="invalid-feedback" style="display: block;">
														<strong>{{ $errors->first('image') }}</strong>
													</span>
												@endif
											</div>
											<div class="col-md-12 button-submit">
												<button type="submit" class="btn btn-primary" form="form-waiter">
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
	<script type="text/javascript"> 
		$('#img_user').change(function(e) {
	    	var file = e.target.files[0],
		    imageType = /image.*/;
		    
		    if (!file.type.match(imageType))
		    return;
		  
		    var reader = new FileReader();
		    reader.onload = function(e) {
		    	var result=e.target.result;
		    	$('#img_user_img').attr("src",result);
		    }
		    reader.readAsDataURL(file);
	    });
	</script>
@endsection

@section('style')	
	<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet"> 
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
	</style>
@endsection