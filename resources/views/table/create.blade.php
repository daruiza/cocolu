@extends('layouts.app')

@section('template')
    
@endsection

@section('content')
<div class="container">
   <div class="flex-center position-ref full-height">
        <div class="col-md-12">
            <div class="content">
               <div class="row">

	        	<div class="col-md-4 ">
            		<div class="card">
	                    <div class="card-header">{{ __('messages.TableService') }}</div>
	                    <div class="card-body">
	                    	<div class="container">
		                    	<div class="row">
			                    	<div class="col-md-12">
			                    		Descripcion de cuenta con respecto a las mesas y cosas asi				                    	                   	
			                    	</div>
			                    </div>	                    			        		
	                    	</div>	        		
	                    </div>
	                    
	                </div>
            	</div>

            	<div class="col-md-8">            		
            		@include('layouts.alert')
            		<div class="card">
	                    <div class="card-header">{{ __('messages.indexTable') }}</div>
	                    <div class="card-body">
	                    	<div class="container">
		                    	<div class="row">
			                    	<div class="col-md-12">
			                    		{!! Form::model($table,['enctype' => 'multipart/form-data','id'=>'form-table','route'=>['table.store'],'method'=>'POST']) !!}
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
				                    			{!! Form::label('label',__('messages.label'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				@if($errors->has('label'))
				                    					{!! Form::text('label',null, ['class'=>'form-control is-invalid']) !!}
				                    					<span class="invalid-feedback">
					                                        <strong>{{ $errors->first('label') }}</strong>
					                                    </span>
				                    				@else
				                    					{!! Form::text('label',null, ['class'=>'form-control']) !!}
				                    				@endif	
				                    			</div>	                    			
				                    		</div>

				                    		<div class="form-group row">
				                    			{!! form::label('order',__('messages.order'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				@if($errors->has('order'))
				                    					{!! Form::text('order',null, ['class'=>'form-control is-invalid']) !!}
				                    					<span class="invalid-feedback">
					                                        <strong>{{ $errors->first('order') }}</strong>
					                                    </span>
				                    				@else
				                    					{!! Form::text('order',null, ['class'=>'form-control']) !!}
				                    				@endif	
				                    			</div>
				                    		</div>

				                    		<div class="form-group row">
				                    			{!! form::label('active',__('messages.active'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
				                    			<div class="col-md-8">
				                    				@if($errors->has('active'))
				                    					{!! Form::text('active',null, ['class'=>'form-control is-invalid']) !!}
				                    					<span class="invalid-feedback">
					                                        <strong>{{ $errors->first('active') }}</strong>
					                                    </span>
				                    				@else
				                    					{!! Form::text('active',null, ['class'=>'form-control']) !!}
				                    				@endif	
				                    			</div>
				                    		</div>


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
                    	</div>
	                </div>
        		</div>

        		</div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('style')
<style>
</style>
@endsection