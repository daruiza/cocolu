@extends('layouts.app')

@section('template')		          	
@endsection

@section('content')
	@include('table.index_basic')

	@isset($data['servicemodal'])
		@include('table.service_create')
	@endisset

	@isset($data['ordermodal'])
		@include('table.order_create')
	@endisset	

	{!! Form::open(array('id'=>'slect-service-form','route' =>['table.selectservice',Auth::user()->store()->id],'method' =>'POST')) !!}
		{!!Form::hidden('store_id', Auth::user()->store()->id)!!}
		
	{!! Form::close() !!}   
@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('js/entity/table.js') }}"></script>
	<script type="text/javascript">
		table.onjquery();
		//validar las opciones
		function table_show_submit(id){
			if($("#"+id+" input[name=id]").val() !== ""){
				$('#'+id)[0].submit();
				return true;
			}
			alert("{{ __('messages.TableSelectNone') }}");
			return false;			
		}

		function table_edit_submit(id){
			if($("#"+id+" input[name=id]").val() !== ""){
				$('#'+id)[0].submit();
				return true;
			}
			alert("{{ __('messages.TableSelectNone') }}");
			return false;			
		}

		function table_destroy_submit(id){			
			if(confirm("{{ __('messages.TableConfirmDestroy') }}")){
				if($("#"+id+" input[name=id]").val() !== ""){
				$('#'+id)[0].submit();
					return true;
				}
				alert("{{ __('messages.TableSelectNone') }}");
				return false;
			}
			return false;
		}

		function table_drag_submit(id){
			$('#'+id)[0].submit();
		}
		
		function table_service_submit(id){
			if($("#"+id+" input[name=id]").val() !== ""){
				$('#'+id)[0].submit();
				return true;
			}
			alert("{{ __('messages.TableSelectNone') }}");
			return false;
		}

		function order_create_submit(id){
			if($("#"+id+" input[name=table-id]").val() !== ""){
				$('#'+id)[0].submit();
				return true;
			}
			alert("{{ __('messages.OrderSelectNone') }}");
			return false;			
		}

		$("#containment-wrapper").height($("#containment-wrapper").height()+125);		
	</script>
		
	@isset($data['servicemodal'])	
	<script type="text/javascript">		
		$('#modal_service_create').modal('toggle');
	</script>
	@endisset
	@isset($data['ordermodal'])	
	<script type="text/javascript">
		$('#modal_order_create').modal('toggle');
	</script>
	@endisset
@endsection

@section('style')	
	<link href="{{ asset('css/custom/table_index.css') }}" rel="stylesheet">    
	<!--esto no se hace asi, css debe poder recivir variables-->
	<style type="text/css">
		.services-table{
			text-align: center;
		}
		.selected-table{
			
		    background-color: {{ json_decode(Auth::user()->store()->label,true)['selectTable'] }} !important;
		}
		.service-open-table{
		    background-color: {{ json_decode(Auth::user()->store()->label,true)['serviceOpenTable'] }};;
		}
		.object-table{
		    height: 100%;
		}
		.unselectable {
		    -webkit-touch-callout: none;
		    -webkit-user-select: none;
		    -khtml-user-select: none;
		    -moz-user-select: none;
		    -ms-user-select: none;
		    user-select: none;
		}

		.order_select_conteiner{
			position: absolute;
    		bottom: 10px;
		}
		

	</style>
	@isset($data['ordermodal'])	
	<style type="text/css">
		/*solo para al modal-order*/
		#modal_order_create .modal-body{
			padding: 0.3rem; 
		}
		#modal_order_create .row .col-sm-3,
		#modal_order_create .row .col-sm-9{
			padding-right: 2px;
    		padding-left: 2px;
		}

		#modal_order_create .card-header,
		#modal_order_create .card-body{
			padding: 0.25rem 0.25rem;
		}

		.tab-content{
			padding-top: 0.5em;
		}
		.tab-content .row .col-md-3{
			padding: 0.25rem 0.25rem;
		}

		.product-conteiner{			
    		border: solid 1px gainsboro;
    		text-align: center;
    		height: 130px;
    		max-height: 140px;
    		background-position: center;
		    background-repeat: no-repeat;
		    background-size: cover;
		    background-color: white; 		    
		    /*
		    -webkit-transition-property: background-color width, height;
			 -webkit-transition-duration: 1s; 
			 transition-property: background-color width, height;
			 transition-duration: 1s;
			 */
			 background-size: 80% 80%;
		    transition: background-size 1s ease-in;
		    -moz-transition: background-size 1s ease-in;
		    -web-kit-transition: background-size 1s ease-in;
		}

		.product-conteiner:hover{
			cursor: pointer;
			/*			
			-ms-transform: scale(1.05); 
			-webkit-transform: scale(1.2);
			transform: scale(1.05);						
			background-size: scale(1.2);
			background-color: #f7f7f7;
			*/
			background-size: 100% 100%;
		}

		.product-conteiner .product-name{
			font-size: 18px;
			font-weight: 400;
		}	

		.product-conteiner  > div{
			background-color: #f7f7f7c7;
		}
		
		.product-conteiner .product-volume{
			position: absolute;
    		bottom: 0px;
			margin: 0.25rem;
			left: 0;
		    right: 0;
		    margin-left: auto;
		    margin-right: auto;
		}
	</style>
	@endisset	
@endsection
