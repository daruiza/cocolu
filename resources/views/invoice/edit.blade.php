@extends('layouts.app')

@section('template')
    
@endsection

@section('content')
<div class="container">
	<div class="flex-center position-ref full-height">
		<div class="col-md-12">
			<div class="content">
               <div class="row">

               		<div class="col-md-3 ">
               			<div class="card">
		                    <div class="card-header">{{ __('messages.InvoiceEdit') }}</div>
		                    <div class="card-body">
		                    	<div class="container">
			                    	<div class="row">
				                    	<div class="col-md-12">
				                    		Descripcion de cuenta con respecto a Facturas
				                    	</div>
				                    </div>	                    			        		
		                    	</div>	        		
		                    </div>		                    
		                </div>
               		</div>

               		<div class="col-md-9">
               			@include('layouts.alert')
            			<div class="card">
		                    <div class="card-header">{{ __('messages.ivoiceExpense') }}</div>
		                    <div class="card-body">
		                    	<div class="container">
			                    	<div class="row">
				                    	<div class="col-md-12">									
				                    		{!! Form::model($invoice,['enctype' => 'multipart/form-data','id'=>'form-invoice','route'=>['invoice.update',$invoice->id],'method'=>'POST']) !!}
				                    			@csrf
			                    	 			{{ method_field('PATCH') }}
				                    			{!!Form::hidden('store-id', Auth::user()->store()->id)!!}
				                    			@include('invoice.form_edit')
				                    		{!! Form::close() !!}
					                    	                   	
				                    	</div>

				                    	{!! Form::select('products',$invoice->store()->first()->products()->first()->productsArrayCategoryAll(),null,['id'=>'products','class'=>'form-control','style'=>'display:none']) !!}

										{!! Form::select('providers',$invoice->provider()->first()->allProviders(),null,['id'=>'providers','class'=>'form-control','style'=>'display:none']) !!}

										<div class="col-md-12 button-submit">
											<button type="submit" class="btn btn-primary" form="form-invoice">
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

{!! Form::open(array('id'=>'form_consult_provider','route' => 'provider.consultprovider','method' =>'POST')) !!}
	{!! Form::hidden('store-id', Auth::user()->store()->id) !!}
	{!! Form::hidden('number') !!}
{!! Form::close() !!}

{!! Form::open(array('id'=>'form_home','url' => '/')) !!}
{!! Form::close() !!}    

{!! Form::hidden('input_placeholder_volume', __('messages.Volume') ) !!}
{!! Form::hidden('input_placeholder_price', __('messages.Price') ) !!}

@endsection

@section('style')
<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet"> 
<link href="{{ asset('css/chosen.min.css') }}" rel="stylesheet"> 
<style>
	#form-invoice .form-group.row{
		border: 1px solid rgba(0,0,0,.125);
		border-radius: .25rem;    
		padding-bottom: 1.25em;
	}

	#form-invoice h5{
		text-align: center;
	}

	.chosen-container-multi .chosen-choices,
	.chosen-container .chosen-single{
		height: calc(2.25rem + 2px);
		padding: .375rem .75rem;
		background-image: -webkit-gradient(linear,left top,left bottom,color-stop(1%,transparent),color-stop(15%,transparent));
		background-image: linear-gradient(transparent 1%,transparent 15%);
		border: 1px solid #ced4da;
		border-radius: .25rem;
	}

	.chosen-container .chosen-single > div{
		top: 6px;
	}

	.ui-autocomplete {
	 	position: absolute;
	  	top: 100%;
		left: 0;
		z-index: 1000;
		float: left;
		display: none;
		min-width: 160px;
		_width: 160px;
		padding: 4px 0;
		margin: 2px 0 0 0;
		list-style: none;
		background-color: #ffffff;
		border-color: #ccc;
		border-color: rgba(0, 0, 0, 0.2);
		border-style: solid;
		border-width: 1px;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		-webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
		-moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
		box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
		-webkit-background-clip: padding-box;
		-moz-background-clip: padding;
		background-clip: padding-box;
		*border-right-width: 2px;
		*border-bottom-width: 2px;

		.ui-menu-item > a.ui-corner-all {
		    display: block;
		    padding: 3px 15px;
		    clear: both;
		    font-weight: normal;
		    line-height: 18px;
		    color: #555555;
		    white-space: nowrap;

		    &.ui-state-hover, &.ui-state-active {
		      color: #ffffff;
		      text-decoration: none;
		      background-color: #0088cc;
		      border-radius: 0px;
		      -webkit-border-radius: 0px;
		      -moz-border-radius: 0px;
		      background-image: none;
	    	}
	  	}
	}

	.details-total{
		text-align: right;
	}

</style>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/chosen.jquery.min.js') }}"></script>	
<script type="text/javascript" src="{{ asset('js/entity/invoice.js') }}"></script>
<script type="text/javascript">
	$('.chosen-select').chosen();
    $('.chosen-container').width('100%');
</script>
@endsection