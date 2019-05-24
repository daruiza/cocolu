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
	                    <div class="card-header">{{ __('form.CategoryService') }}</div>
	                    <div class="card-body">
	                    	<div class="container">
		                    	<div class="row">
			                    	<div class="col-md-12">
			                    		Descripcion de cuenta con respecto a categoria
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
	                    <div class="card-header">{{ __('form.createCategory') }}</div>
	                    <div class="card-body">
	                    	<div class="container">
		                    	<div class="row">
			                    	<div class="col-md-12">
			                    		{!! Form::model($category,['enctype' => 'multipart/form-data','id'=>'form-category','route'=>['category.store'],'method'=>'POST']) !!}

			                    			{!!Form::hidden('store_id', Auth::user()->store()->id)!!}
			                    			@include('category.form')

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
	<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet"> 	
	<style>
		select {
		  font-family: 'FontAwesome';
		}
	</style>
@endsection