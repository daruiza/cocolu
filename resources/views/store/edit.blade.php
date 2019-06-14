@extends('layouts.app')

@section('template')
  	<link href="{{ asset('css/custom/edit.css') }}" rel="stylesheet">    
  	<link href="{{ asset('css/custom/perfil.css') }}" rel="stylesheet">
  	<link href="{{ asset('css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
@endsection

@section('content')
	<div class="flex-center position-ref full-height container">    
	    <div class="container">
	        <div class="row row-edit-perfil">

	        	<div class="col-md-4 ">
            		<div class="card">
	                    <div class="card-header">{{ __('messages.Options') }}</div>
	                    @if (!empty($data['options']) )
	                    	@include('layouts.form_options_profile')
	                    @endif	                    
                	</div>
            	</div>

	        	
            	<div class="col-md-8">            		
            		@include('layouts.alert')
            		<div class="card">
	                    <div class="card-header">{{ __('messages.editStore') }}</div>
	                    <div class="card-body">
	                    	<div class="col-md-8">
		                    	{!! Form::model($store,['enctype' => 'multipart/form-data','id'=>'edit-form-store','route'=>['store.update',$store->id],'method'=>'PUT']) !!}

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
											<div class="form-group row">
				                    			{!! Form::label('name',__('messages.Name'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				@if($errors->has('name'))
				                    					{!! Form::text('name',null, ['class'=>'form-control is-invalid']) !!}
				                    					<span class="invalid-feedback">
					                                        <strong>{{ $errors->first('name') }}</strong>
					                                    </span>
				                    				@else
				                    					{!! Form::text('name',null, ['class'=>'form-control']) !!}
				                    				@endif	
				                    			</div>
				                    		</div>


				                    		<div class="form-group row">
				                    			{!! Form::label('department',__('messages.DepartmentLabel'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				{!! Form::select('department',$departments,null, array('class' => 'form-control chosen-select','placeholder'=>__('messages.Department'))) !!}
				                    				@if ($errors->has('department'))		                        	
							                            <span class="invalid-feedback" style="display: block;">
							                                <strong>{{ $errors->first('department') }}</strong>
							                            </span>
							                        @endif
				                    			</div>
				                    		</div>

				                    		<div class="form-group row">
				                    			{!! Form::label('city',__('messages.CityLabel'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				{!! Form::select('city',$cities,null, array('class' => 'form-control chosen-select','placeholder'=>__('messages.City'))) !!}
				                    				@if ($errors->has('city'))		                        	
							                            <span class="invalid-feedback" style="display: block;">
							                                <strong>{{ $errors->first('city') }}</strong>
							                            </span>
							                        @endif
				                    			</div>
				                    		</div>

				                    		<div class="form-group row">
				                    			{!! Form::label('adress',__('messages.Adress'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				@if($errors->has('adress'))
				                    					{!! Form::text('adress',null, ['class'=>'form-control is-invalid']) !!}
				                    					<span class="invalid-feedback">
					                                        <strong>{{ $errors->first('adress') }}</strong>
					                                    </span>
				                    				@else
				                    					{!! Form::text('adress',null, ['class'=>'form-control']) !!}
				                    				@endif	
				                    			</div>	                    			
				                    		</div>

				                    		<div class="form-group row">
				                    			{!! Form::label('description',__('messages.Description'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				@if($errors->has('description'))
				                    					{!! Form::text('description',null, ['class'=>'form-control is-invalid']) !!}
				                    					<span class="invalid-feedback">
					                                        <strong>{{ $errors->first('description') }}</strong>
					                                    </span>
				                    				@else
				                    					{!! Form::text('description',null, ['class'=>'form-control']) !!}
				                    				@endif	
				                    			</div>	                    			
				                    		</div>

				                    		<div class="form-group row">
				                    			{!! Form::label('currency',__('messages.Currency'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				@if($errors->has('currency'))
				                    					{!! Form::text('currency',null, ['class'=>'form-control is-invalid']) !!}
				                    					<span class="invalid-feedback">
					                                        <strong>{{ $errors->first('currency') }}</strong>
					                                    </span>
				                    				@else
				                    					{!! Form::text('currency',null, ['class'=>'form-control']) !!}
				                    				@endif	
				                    			</div>	                    			
				                    		</div>

				                    		<input id="img_store"  style="display: none;" name="image" type="file">
					                        <!--
				                    	 	<div class="form-group row mb-0">
					                            <div class="col-md-8 offset-md-4">
					                                <button type="submit" class="btn btn-primary">
					                                    {{ __('messages.Send') }}
					                                </button>	                                
					                            </div>
					                        </div>
					                        -->
										</div>
										<div class="tab-pane fade show" id="components" role="tabpanel" aria-labelledby="component-tab">
											<div class="form-group row">
				                    			{!! Form::label('storeheight',__('messages.Storeheight'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				@if($errors->has('storeheight'))
				                    					{!! Form::text('storeheight',null, ['class'=>'form-control is-invalid']) !!}
				                    					<span class="invalid-feedback">
					                                        <strong>{{ $errors->first('storeheight') }}</strong>
					                                    </span>
				                    				@else
				                    					{!! Form::text('storeheight',null, ['class'=>'form-control']) !!}
				                    				@endif	
				                    			</div>
				                    		</div>

				                    		<div class="form-group row">
				                    			{!! Form::label('tableheight',__('messages.tableHeight'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				@if($errors->has('tableheight'))
				                    					{!! Form::text('tableheight',null, ['class'=>'form-control is-invalid']) !!}
				                    					<span class="invalid-feedback">
					                                        <strong>{{ $errors->first('tableheight') }}</strong>
					                                    </span>
				                    				@else
				                    					{!! Form::text('tableheight',null, ['class'=>'form-control']) !!}
				                    				@endif	
				                    			</div>
				                    		</div>

				                    		<div class="form-group row">
				                    			{!! Form::label('selecttable',__('messages.selectTable'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				<div id="cnt-selecttable" class="input-group">
				                    					@if($errors->has('selecttable'))
				                    					{!! Form::text('selecttable',null, ['class'=>'form-control is-invalid ']) !!}
				                    					<span class="invalid-feedback">
					                                        <strong>{{ $errors->first('selecttable') }}</strong>
					                                    </span>
					                    				@else
					                    					{!! Form::text('selecttable',null, ['class'=>'form-control']) !!}
					                    				@endif
					                    				<span class="input-group-append">
															<span class="input-group-text colorpicker-input-addon"><i></i></span>
														</span>
				                    				</div>
				                    			</div>
				                    		</div>

				                    		<div class="form-group row">
				                    			{!! Form::label('selecttable',__('messages.serviceOpenTable'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				<div id="cnt-serviceopentable" class="input-group">
				                    					@if($errors->has('serviceopentable'))
				                    					{!! Form::text('serviceopentable',null, ['class'=>'form-control is-invalid ']) !!}
				                    					<span class="invalid-feedback">
					                                        <strong>{{ $errors->first('serviceopentable') }}</strong>
					                                    </span>
					                    				@else
					                    					{!! Form::text('serviceopentable',null, ['class'=>'form-control']) !!}
					                    				@endif
					                    				<span class="input-group-append">
															<span class="input-group-text colorpicker-input-addon"><i></i></span>
														</span>
				                    				</div>				                    			
												</div>				                    			
				                    		</div>

				                    		<div class="form-group row">
				                    			{!! Form::label('colorrow',__('messages.colorRow'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				<div id="cnt-colorrow" class="input-group">
				                    					@if($errors->has('colorrow'))
				                    					{!! Form::text('colorrow',null, ['class'=>'form-control is-invalid ']) !!}
				                    					<span class="invalid-feedback">
					                                        <strong>{{ $errors->first('colorrow') }}</strong>
					                                    </span>
					                    				@else
					                    					{!! Form::text('colorrow',null, ['class'=>'form-control']) !!}
					                    				@endif
					                    				<span class="input-group-append">
															<span class="input-group-text colorpicker-input-addon"><i></i></span>
														</span>
				                    				</div>				                    			
												</div>				                    			
				                    		</div>

				                    		<div class="form-group row">
				                    			{!! Form::label('colorinactive',__('messages.colorInactive'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				<div id="cnt-colorinactive" class="input-group">
				                    					@if($errors->has('colorinactive'))
				                    					{!! Form::text('colorinactive',null, ['class'=>'form-control is-invalid ']) !!}
				                    					<span class="invalid-feedback">
					                                        <strong>{{ $errors->first('colorinactive') }}</strong>
					                                    </span>
					                    				@else
					                    					{!! Form::text('colorinactive',null, ['class'=>'form-control']) !!}
					                    				@endif
					                    				<span class="input-group-append">
															<span class="input-group-text colorpicker-input-addon"><i></i></span>
														</span>
				                    				</div>				                    			
												</div>				                    			
				                    		</div>

				                    		<div class="form-group row">
				                    			{!! Form::label('ordernew',__('messages.OrderNew'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				<div id="cnt-ordernew" class="input-group">
				                    					@if($errors->has('ordernew'))
				                    					{!! Form::text('ordernew',null, ['class'=>'form-control is-invalid ']) !!}
				                    					<span class="invalid-feedback">
					                                        <strong>{{ $errors->first('ordernew') }}</strong>
					                                    </span>
					                    				@else
					                    					{!! Form::text('ordernew',null, ['class'=>'form-control']) !!}
					                    				@endif
					                    				<span class="input-group-append">
															<span class="input-group-text colorpicker-input-addon"><i></i></span>
														</span>
				                    				</div>				                    			
												</div>				                    			
				                    		</div>

				                    		<div class="form-group row">
				                    			{!! Form::label('orderok',__('messages.OrderOK'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				<div id="cnt-orderok" class="input-group">
				                    					@if($errors->has('orderok'))
				                    					{!! Form::text('orderok',null, ['class'=>'form-control is-invalid ']) !!}
				                    					<span class="invalid-feedback">
					                                        <strong>{{ $errors->first('orderok') }}</strong>
					                                    </span>
					                    				@else
					                    					{!! Form::text('orderok',null, ['class'=>'form-control']) !!}
					                    				@endif
					                    				<span class="input-group-append">
															<span class="input-group-text colorpicker-input-addon"><i></i></span>
														</span>
				                    				</div>				                    			
												</div>				                    			
				                    		</div>

				                    		<div class="form-group row">
				                    			{!! Form::label('orderpay',__('messages.OrderPay'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				<div id="cnt-orderpay" class="input-group">
				                    					@if($errors->has('orderpay'))
				                    					{!! Form::text('orderpay',null, ['class'=>'form-control is-invalid ']) !!}
				                    					<span class="invalid-feedback">
					                                        <strong>{{ $errors->first('orderpay') }}</strong>
					                                    </span>
					                    				@else
					                    					{!! Form::text('orderpay',null, ['class'=>'form-control']) !!}
					                    				@endif
					                    				<span class="input-group-append">
															<span class="input-group-text colorpicker-input-addon"><i></i></span>
														</span>
				                    				</div>				                    			
												</div>				                    			
				                    		</div>

				                    		<div class="form-group row">
				                    			{!! Form::label('ordercancel',__('messages.OrderCancel'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				<div id="cnt-ordercancel" class="input-group">
				                    					@if($errors->has('ordercancel'))
				                    					{!! Form::text('ordercancel',null, ['class'=>'form-control is-invalid ']) !!}
				                    					<span class="invalid-feedback">
					                                        <strong>{{ $errors->first('ordercancel') }}</strong>
					                                    </span>
					                    				@else
					                    					{!! Form::text('ordercancel',null, ['class'=>'form-control']) !!}
					                    				@endif
					                    				<span class="input-group-append">
															<span class="input-group-text colorpicker-input-addon"><i></i></span>
														</span>
				                    				</div>				                    			
												</div>				                    			
				                    		</div>

				                    		
				                    		

										</div>
									</div>

		                    		
		                    	{!! Form::close() !!}
	                    	</div>
	                    	<div class="col-md-4">        			
			        			<div class="col-md-12 img-container">
									{{ Html::image('users/'.\Auth::user()->id.'/stores/'.$store->logo,'Imagen no disponible',array('id'=>'img_user_img','style'=>'width: 100%; border:2px solid #ddd;border-radius: 0%;','onclick'=>'$("#img_store").trigger("click")'))}}
									@if ($errors->has('image'))		                        	
			                            <span class="invalid-feedback" style="display: block;">
			                                <strong>{{ $errors->first('image') }}</strong>
			                            </span>
			                        @endif
								</div>
								<div class="col-md-12 button-submit">
				        			<button type="submit" class="btn btn-primary" form="edit-form-store">
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

    <!-- Form en blanco para consultar Ciudades -->
	{!! Form::open(array('id'=>'form_consult_city','url' => 'storecitytrait')) !!}		
    {!! Form::close() !!}
    
@endsection


@section('script')
	<script type="application/javascript" src="{{ asset('js/bootstrap-colorpicker.min.js') }}"></script>	
	<script type="application/javascript"> 
		$('#img_store').change(function(e) {
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

	    $("#department").change(function() {
			var datos = new Array();
			datos['id'] =$( "#department option:selected" ).val();			   
			ajaxobject.peticionajax($('#form_consult_city').attr('action'),datos,"store.consultaRespuestaCity");
		});

		colorPiker('cnt-selecttable');
	    colorPiker('cnt-serviceopentable');
	    colorPiker('cnt-colorrow');
	    colorPiker('cnt-colorinactive');
	    colorPiker('cnt-ordernew');
	    colorPiker('cnt-orderok');
	    colorPiker('cnt-orderpay');
	    colorPiker('cnt-ordercancel');	    

	    function colorPiker(id){
			$('#'+id).colorpicker({      
		      container: true,
		      extensions: [{
		          name: 'swatches', // extension name to load
		          options: { // extension options
		            colors: {
		              'black': '#000000',
		              'gainsboro': 'gainsboro',
		              'white': '#ffffff',		              
		              'lemonchiffon': 'lemonchiffon',
		              'sandybrown': 'sandybrown',
		              'aliceblue': 'aliceblue',
		              'cadetblue': 'cadetblue',
		              'cornflowerblue': 'cornflowerblue',
		              'slategrey': 'slategrey',
		              'antiquewhite':'antiquewhite',
		              'chartreuse':'chartreuse',
		              'yellow':'yellow',
		              'violet':'violet',
		              'tomato':'tomato',
		              'teal':'teal',
		              'skyblue':'skyblue',
		            },
		            namesAsValues: true
		          }
		        }
		      ]
		    });	    	
	    }

	</script>
@endsection

@section('style')
	<style type="text/css">		
		.row-edit-perfil div:nth-of-type(2) .card-body{
			display: flex;
		}

		.col-form-label{			
			padding: 0px;
			padding-top: calc(.375rem + 1px);
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
		.tab-content{
			margin-top: 10px;
		}
	</style>
@endsection