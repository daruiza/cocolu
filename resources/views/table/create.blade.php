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

			                    			{!!Form::hidden('store_id', Auth::user()->store()->id)!!}
			                    			
			                    			@include('table.form')

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
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
	select {
	  font-family: 'FontAwesome';
	}
</style>
@endsection