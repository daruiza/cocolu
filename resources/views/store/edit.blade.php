@extends('layouts.app')

@section('template')
  	<link href="{{ asset('css/custom/edit.css') }}" rel="stylesheet">    
@endsection

@section('content')
	<div class="flex-center position-ref full-height container">    
	    <div class="container">
	        <div class="row row-edit-perfil">

            	<div class="col-md-8">
            		@include('layouts.alert')
            		<div class="card">
	                    <div class="card-header">{{ __('messages.editStore') }}</div>
	                    <div class="card-body">

	                    	{!! Form::model($store,['enctype' => 'multipart/form-data','route'=>['store.update',$store->id],'method'=>'PUT']) !!}

	                    		<div class="form-group row">
	                    			{!! Form::label('name',__('messages.Name'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	                    			<div class="col-md-6">
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
	                    			{!! Form::label('department',__('messages.Department'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	                    			<div class="col-md-6">
	                    				{!! Form::select('department',$departments,null, array('class' => 'form-control chosen-select','placeholder'=>__('messages.Department'))) !!}
	                    				@if ($errors->has('department'))		                        	
				                            <span class="invalid-feedback" style="display: block;">
				                                <strong>{{ $errors->first('department') }}</strong>
				                            </span>
				                        @endif
	                    			</div>
	                    		</div>

	                    		<div class="form-group row">
	                    			{!! Form::label('city',__('messages.City'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	                    			<div class="col-md-6">
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
	                    			<div class="col-md-6">
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
	                    			<div class="col-md-6">
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
	                    			<div class="col-md-6">
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
		                        
	                    	 	<div class="form-group row mb-0">
		                            <div class="col-md-8 offset-md-4">
		                                <button type="submit" class="btn btn-primary">
		                                    {{ __('messages.Send') }}
		                                </button>	                                
		                            </div>
		                        </div>
	                    	{!! Form::close() !!}
	                    </div>
	                </div>
        		</div>

        		<div class="col-md-4">        			
        			<div class="col-md-9 offset-md-1 img-container">
						{{ Html::image('users/'.\Auth::user()->id.'/stores/'.$store->logo,'Imagen no disponible',array('id'=>'img_user_img','style'=>'width: 100%; border:2px solid #ddd;border-radius: 0%;','onclick'=>'$("#img_store").trigger("click")'))}}
						@if ($errors->has('image'))		                        	
                            <span class="invalid-feedback" style="display: block;">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
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
	<script type="text/javascript"> 
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

	</script>
@endsection