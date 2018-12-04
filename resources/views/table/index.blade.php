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
	</script>
@endsection

@section('style')
	<link href="{{ asset('css/custom/table_index.css') }}" rel="stylesheet">    
@endsection