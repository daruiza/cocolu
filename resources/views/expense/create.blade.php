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
										<div class="col-md-12">
											{!! Form::model($expense,['enctype' => 'multipart/form-data','id'=>'form-expense','route'=>['expense.store'],'method'=>'POST']) !!}

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

@section('script')

@endsection

@section('style')
<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet">
<style type="text/css">

</style>
@endsection