@extends('layouts.app')

@section('template')		          	
@endsection

@section('content')
	@include('table.index_basic')    
@endsection


@section('script')

	<script type="text/javascript" src="{{ url('js/jquery.ui.core.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/jquery.ui.widget.js')}}"></script>
    <script type="text/javascript" src="{{ url('js/jquery.ui.mouse.js')}}"></script>
    <script type="text/javascript" src="{{ url('js/jquery.ui.draggable.js')}}"></script>
	<script type="text/javascript" src="{{ url('js/jquery-collision.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/jquery-ui-draggable-collision.min.js') }}"></script>    
    
    <!--<script type="text/javascript" src="{{ asset('js/entity/table.js') }}"></script>-->

	<script type="text/javascript">		
		if($( window ).width() > 768){		
			$( ".draggable" ).draggable({ 
				containment: "#containment-wrapper", 
				scroll: false ,
				obstacle: ".obstacle",
	    		preventCollision: true
	    	});

	    	$(".draggable").hover(function() {
			    $(this).removeClass("obstacle");
			}, function() {
			    $(this).addClass("obstacle");
			});

			$("#containment-wrapper").height($("#containment-wrapper").height()+55);
		}

		//table.selectTable('object-table','selected-table');

	</script>
@endsection

@section('style')
	<link href="{{ asset('css/custom/table_index.css') }}" rel="stylesheet">    
@endsection