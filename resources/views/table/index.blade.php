@extends('layouts.app')

@section('template')		          	
@endsection

@section('content')
	@include('table.index_basic')    
@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('js/entity/table.js') }}"></script>
	<script type="text/javascript">
		table.selectTable('object-table','selected-table');
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

		$("#containment-wrapper").height($("#containment-wrapper").height()+85);
		
	</script>
@endsection

@section('style')	
	<link href="{{ asset('css/custom/table_index.css') }}" rel="stylesheet">    
	<!--esto no se hace asi, css debe poder recivir variables-->
	<style type="text/css">
		.selected-table{
		    background-color: {{ json_decode(Auth::user()->store()->label,true)['selectTable'] }};
		}
	</style>
	
@endsection