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
				                    		Descripcion de categoria a punto de editar
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
				                    		{!! Form::model($category,['enctype' => 'multipart/form-data','id'=>'form-category','route'=>['category.update',$category->id],'method'=>'POST']) !!}
				                    			@csrf
			                    	 			{{ method_field('PATCH') }}
			                    	 			{!!Form::hidden('id', $category->id)!!}
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

@section('script')
@endsection

@section('style')
@endsection