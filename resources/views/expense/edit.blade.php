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
		                    <div class="card-header">{{ __('messages.ExpenseEdit') }}</div>
		                    <div class="card-body">
		                    	<div class="container">
			                    	<div class="row">
				                    	<div class="col-md-12">
				                    		Descripcion de cuenta con respecto a gastos
				                    	</div>
				                    </div>	                    			        		
		                    	</div>	        		
		                    </div>		                    
		                </div>
               		</div>

               		<div class="col-md-8">            		
            			@include('layouts.alert')
            			<div class="card">
		                    <div class="card-header">{{ __('messages.indexExpense') }}</div>
		                    <div class="card-body">
		                    	<div class="container">
			                    	<div class="row">
				                    	<div class="col-md-12">									
				                    		{!! Form::model($expense,['enctype' => 'multipart/form-data','id'=>'form-expense','route'=>['expense.update',$expense->id],'method'=>'POST']) !!}
				                    			@csrf
			                    	 			{{ method_field('PATCH') }}
				                    			{!!Form::hidden('store-id', Auth::user()->store()->id)!!}
				                    			@include('expense.form')
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
@endsection

@section('script')
@endsection