@extends('layouts.app')

@section('template')		          	
@endsection

@section('content')
	@include('table.index_basic_drag')
	<div class="flex-center position-ref full-height container">  
	<div class="container">
        <div class="row">        	
        	<div class="col-md-3">
    			<a class="btn btn-primary" href="javascript: table_drag_save_submit('table-drag-save-form')">
			    	<i class=""></i>
			        {{ __('messages.BottonSave') }}
			    </a>


			    {!! Form::open(array('id'=>'table-drag-save-form','route' =>['table.savedrag',Auth::user()->store()->id],'method' =>'POST')) !!}
			    	{!! Form::hidden('data','') !!}			    	
			    {!! Form::close() !!}   
        	</div>
        </div>
    </div>   		
	</div>
	
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

			$("#containment-wrapper").height($("#containment-wrapper").height()+85);
		}

		//table.selectTable('object-table','selected-table');
		function table_drag_save_submit(id){
			//id es el id del form
			//recoleccion de datos de posicion de las tablas			
			var i = 0;
			data = new Array();
			$.each( $('#containment-wrapper').children(), function( key, value ) {			  
				data[i] = {
		  			"id":$(value).children()[0].value,
		  			"top":value.style.top,
		  			"right":value.style.right,
					"bottom":value.style.bottom,
					"left":value.style.left					
				};
				i++;	  
			});
			//por ajax funciona y retorna a la funcion en javascript
			//ajaxobject.peticionajax($('#'+id).attr('action'),data,"formDragSaveResponse");
			$($('#'+id)[0]).children()[1].value = JSON.stringify(data);
			$('#'+id)[0].submit();
		}

		function formDragSaveResponse(result) {
			alert('OKResponse');
		}

	</script>
@endsection

@section('style')
	<link href="{{ asset('css/custom/table_index.css') }}" rel="stylesheet">    
	<style type="text/css">
		.draggable {			
			cursor: grabbing;	
		}

		.draggable:hover{ 
			background-color: whitesmoke;
		}
	</style>
@endsection