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

	{!! Form::open(array('id'=>'form_add_product','route' =>['product.addproduct',Auth::user()->store()->id],'method' =>'POST')) !!}
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
	<script type="text/javascript">		
		$('#modal_service_create').modal('toggle');
	</script>
	@endisset

	@isset($data['ordermodal'])
		<script type="text/javascript" src="{{ asset('js/traits/order_create.js') }}"></script>
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
		<link href="{{ asset('css/custom/order_create.css') }}" rel="stylesheet">
	@endisset

@endsection
