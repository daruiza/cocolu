@extends('layouts.app')

@section('template')		          	
@endsection

@section('content')
	@include('table.index_basic')

	@include('order.view')

	@isset($data['servicemodal'])
		@include('service.create')
	@endisset

	@isset($data['servicemodalclose'])
		@include('service.close')
	@endisset

	@isset($data['ordermodal'])
		@include('order.create')
	@endisset

	{!! Form::open(array('id'=>'form-table-home','route' =>['table.index'],'method' =>'GET')) !!}
	{!! Form::close() !!}

	{!! Form::open(array('id'=>'slect-service-form','route' =>['table.selectservice',Auth::user()->store()->id],'method' =>'POST')) !!}
		{!!Form::hidden('store_id', Auth::user()->store()->id)!!}		
	{!! Form::close() !!}   

	{!! Form::open(array('id'=>'form_add_product','route' =>['product.addproduct',Auth::user()->store()->id],'method' =>'POST')) !!}
		{!!Form::hidden('store_id', Auth::user()->store()->id)!!}		
	{!! Form::close() !!}   

@endsection

@section('script')
	<script type="application/javascript" src="{{ asset('js/entity/table.js') }}"></script>
	<script type="application/javascript" src="{{ asset('js/entity/order.js') }}"></script>				
	<script type="application/javascript">
		table.onjquery();
		order.onjquery();//para pintar el modal de una orden
		//validar las opciones
		function table_show_submit(id){
			if($("#"+id+" input[name=id]").val() !== ""){
				$('#'+id)[0].submit();
				return true;
			}			
			$('#modal-alert .content-text').html("{{ __('messages.TableSelectNone') }}");
			$("#modal-alert").modal('show');
			return false;			
		}

		function table_edit_submit(id){
			if($("#"+id+" input[name=id]").val() !== ""){
				$('#'+id)[0].submit();
				return true;
			}
			$('#modal-alert .content-text').html("{{ __('messages.TableSelectNone') }}");
			$("#modal-alert").modal('show');
			return false;			
		}

		function table_destroy_submit(id){

			if($("#"+id+" input[name=id]").val() !== ""){
				$('#modal-confirm .submit').attr('form',id);
				$('#modal-confirm .content-text').html("{{ __('messages.ConfirmOption') }}");
				$('#modal-confirm').modal('show');				
				return false;				
			}
			$('#modal-alert .content-text').html("{{ __('messages.TableSelectNone') }}");
			$("#modal-alert").modal('show');
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
			$('#modal-alert .content-text').html("{{ __('messages.TableSelectNone') }}");
			$("#modal-alert").modal('show');
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

		function order_paid_submit(id){			
			//$('#'+id)[0].submit();
			
			var data = new Array();
			data['store_id'] = $("#"+id+" input[name=store-id]").val();			
			data['table_id'] = $("#"+id+" input[name=table-id]").val();				
			ajaxobject.peticionajax($('#'+id).attr('action'),data,"table.orderPaidResponse");
		}		

		$("#containment-wrapper").height($("#containment-wrapper").height()+
			{!! json_decode(Auth::user()->store()->label,true)['table']['StoreHeight'] !!});
		
		/*Multiple Modal*/
		$(document).on('show.bs.modal', '.modal', function (event) {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });
	</script>
		
	@isset($data['servicemodal'])	
	<script type="application/javascript">		
		$('#modal_service_create').modal('toggle');		
	</script>
	@endisset

	@isset($data['servicemodalclose'])	
	<script type="application/javascript">		
		$('#modal_service_close').modal('toggle');		
	</script>
	@endisset

	
	
	@isset($data['ordermodal'])
		<script type="application/javascript" src="{{ asset('js/traits/order_detail.js') }}"></script>
		<script type="application/javascript" src="{{ asset('js/traits/order_create.js') }}"></script>		
	@endisset

@endsection

@section('style')	
	<link href="{{ asset('css/custom/table_index.css') }}" rel="stylesheet">
	<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet">    
	<!--esto no se hace asi, css debe poder recivir variables-->
	<style type="text/css">
		/*
		#modal_order_create .row{
			border: 1px solid {{ json_decode(Auth::user()->store()->label,true)['table']['colorRow'] }};
		}
		*/
		.draggable { 			
			height: {{ json_decode(Auth::user()->store()->label,true)['table']['TableHeight'] }}px;			
		}
		.row-impar{
		    background-color: {{ json_decode(Auth::user()->store()->label,true)['table']['colorRow'] }};
		}
		.services-table{
			text-align: center;
		}
		.selected-table{			
		    background-color: {{ json_decode(Auth::user()->store()->label,true)['table']['selectTable'] }} !important;
		}
		.service-open-table{
		    background-color: {{ json_decode(Auth::user()->store()->label,true)['table']['serviceOpenTable'] }};
		}		

		.service-open-table.status-OrderNew{	
			background-color: {{ json_decode(Auth::user()->store()->label,true)['order']['OrderNew'] }};
		}

		.badge{	
			color: {{ json_decode(Auth::user()->store()->label,true)['order']['OrderNew'] }};
		}

		.status-OrderNew{			
			background-color: {{ json_decode(Auth::user()->store()->label,true)['order']['OrderNew'] }};
		}

		.menu-status-OrderNew{
			/*
			box-shadow: 0 2px 4px 0 {{ json_decode(Auth::user()->store()->label,true)['order']['OrderOK'] }},0 2px 10px 0 {{ json_decode(Auth::user()->store()->label,true)['order']['OrderOK'] }};
			*/
		}

		.status-OrderOK{
			/*
			box-shadow: 0 2px 4px 0 {{ json_decode(Auth::user()->store()->label,true)['order']['OrderNew'] }},0 2px 10px 0 {{ json_decode(Auth::user()->store()->label,true)['order']['OrderNew'] }};
			*/
			background-color: {{ json_decode(Auth::user()->store()->label,true)['order']['OrderOK'] }};	
		}
		/*
		.status-OrderCancel{			
			background-color: {{ json_decode(Auth::user()->store()->label,true)['order']['OrderCancel'] }};
			color: {{ json_decode(Auth::user()->store()->label,true)['order']['OrderNew'] }};	
		}
		*/		

		.status-OrderPay{			
			background-color: {{ json_decode(Auth::user()->store()->label,true)['order']['OrderPay'] }};
			/*
			coor: {{ json_decode(Auth::user()->store()->label,true)['order']['OrderNew'] }};	
			*/
		}

		.control-checkbox{
			height: calc(2.25rem + 2px);
    		width: 100%;
		}
	</style>

	@isset($data['ordermodal'])	
		<link href="{{ asset('css/custom/order_create.css') }}" rel="stylesheet">
	@endisset

@endsection
